const { emit, off } = require("process");

const fs = require("fs"),
  https = require("https"),
  express = require("express"),
  socketIo = require("socket.io"),
  mysql = require("mysql"),
  os = require("os"),
  path = require("path"),
  app = express();

// Define the directory for your static files
// const staticDirectory = path.join(__dirname, "../javascript/webRtc");

// Tell Express to serve static files from the specified directory
// app.use(express.static(staticDirectory));

//   gating hostname
const networkInterfaces = os.networkInterfaces();
let ipAddresses = [];
for (const name of Object.keys(networkInterfaces)) {
  for (const net of networkInterfaces[name]) {
    // Skip over non-IPv4 and internal (i.e. 127.0.0.1) addresses
    if (net.family === "IPv4" && !net.internal) {
      ipAddresses.push(net.address);
    }
  }
}
// const host = "https://192.168.0.65"
// const host = "https://localhost"
const host = `https://${ipAddresses[2]}`;
const port = 4000;
// Load HTTPS key and certificate
//we need a key and cert to run https
//we generated them with mkcert
// $ mkcert create-ca
// $ mkcert create-cert
const key = fs.readFileSync("cert.key");
const cert = fs.readFileSync("cert.crt");

// HTTPS configuration
const httpsServer = https.createServer({ key, cert }, app);

// Socket.io configuration
const io = socketIo(httpsServer, {
  cors: {
    origin: [host],
    methods: ["GET", "POST"],
  },
});
httpsServer.listen(port, () => {
  console.log(`server running on - ${host + ":" + port}`);
  console.log(`server running on - ${host}/therapy-now`);
});

// Namespaces
const webRtcNamespace = io.of("/webRtc");
const chatNamespace = io.of("/chat");

// Database  connection
const connection = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "therapy",
});
connection.connect((err) => {
  if (err) throw err;
  console.log("Connected to MySQL database");
});

//offers will contain {}
const offers = [
  // offererUserName
  // offer
  // offerIceCandidates
  // answererUserName
  // answer
  // answererIceCandidates
];

const connectedSockets = [
  //username, socketId
];

//create our socket.io server... it will listen to our express port
// webRtc signaling event handlers (in webRtcNamespace)
webRtcNamespace.on("connection", (socket) => {
  console.log("Someone has connected in webRtcNamespace");

  const userName = socket.handshake.auth.userName;
  const password = socket.handshake.auth.password;
  console.log(userName);

  // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
  // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

  socket.on("joinRoom", (roomId) => {
    socket.join(roomId);
  });

  socket.on("callRequest", (data) => {
    const { callerId, recipientId, roomId } = data;
    console.log("Received call request:", data);

    webRtcNamespace.to(roomId).emit("logCallerId", { callerId, recipientId });
  });

  // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
  // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

  if (password !== "p") {
    socket.disconnect(true);
    return;
  }
  connectedSockets.push({
    socketId: socket.id,
    userName,
  });
  //a new client has joined. If there are any offers available,
  //emit them out
  if (offers.length) {
    socket.emit("availableOffers", offers);
  }

  socket.on("newOffer", (newOffer) => {
    offers.push({
      offererUserName: userName,
      offer: newOffer,
      offerIceCandidates: [],
      answererUserName: null,
      answer: null,
      answererIceCandidates: [],
    });
    console.log(newOffer.sdp.slice(50));
    //send out to all connected sockets EXCEPT the caller
    socket.broadcast.emit("newOfferAwaiting", offers.slice(-1));
  });

  socket.on("newAnswer", (offerObj, ackFunction) => {
    console.log(offerObj);
    //emit this answer (offerObj) back to CLIENT1
    //in order to do that, we need CLIENT1's socket id
    const socketToAnswer = connectedSockets.find(
      (s) => s.userName === offerObj.offererUserName
    );
    if (!socketToAnswer) {
      console.log("No matching socket");
      return;
    }
    //we found the matching socket, so we can emit to it!
    const socketIdToAnswer = socketToAnswer.socketId;
    //we find the offer to update so we can emit it
    const offerToUpdate = offers.find(
      (o) => o.offererUserName === offerObj.offererUserName
    );
    if (!offerToUpdate) {
      console.log("No OfferToUpdate");
      return;
    }
    //send back to the answerer all the iceCandidates we have already collected
    ackFunction(offerToUpdate.offerIceCandidates);
    offerToUpdate.answer = offerObj.answer;
    offerToUpdate.answererUserName = userName;
    console.log("offerUpdate: " + offerToUpdate);
    //socket has a .to() which allows emitting to a "room"
    //every socket has it's own room
    socket.to(socketIdToAnswer).emit("answerResponse", offerToUpdate);
  });

  // socket.on("sendIceCandidateToSignalingServer", (iceCandidateObj) => {
  //   const { didIOffer, iceUserName, iceCandidate } = iceCandidateObj;
  //   console.log(iceCandidate);
  //   console.log("iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii---------------",iceUserName)
  //   if (didIOffer) {
  //     //this ice is coming from the offerer. Send to the answerer
  //     const offerInOffers = offers.find((o) => o.offererUserName === iceUserName);
  //     if (offerInOffers) {
  //       offerInOffers.offerIceCandidates.push(iceCandidate);
  //       // 1. When the answerer answers, all existing ice candidates are sent
  //       // 2. Any candidates that come in after the offer has been answered, will be passed through
  //       if (offerInOffers.answererUserName) {
  //         //pass it through to the other socket
  //         const socketToSendTo = connectedSockets.find((s) => s.userName === offerInOffers.answererUserName);
  //         if (socketToSendTo) {
  //           webRtcNamespace.to(socketToSendTo.socketId).emit("receivedIceCandidateFromServer", iceCandidate);
  //         } else {
  //           console.log("Ice candidate received but could not find answer");
  //         }
  //       }
  //     }
  //   } else {
  //     //this ice is coming from the answerer. Send to the offerer
  //     //pass it through to the other socket
  //     console.log("ffffffffffffffffffffffffffffffffፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍፍffffffffffff")
  //     console.log("offers", offers)

  //     console.log("offerooooooooooooooooooooooo", offers.answererIceCandidates)

  //     console.log("llllllllllllllllllllllllllllllllllllllllll")
  //     const offerInOffers = offers.find( o => o.answererUserName === iceUserName);

  //     console.log("offerInOffers", offerInOffers)
  //     const socketToSendTo = connectedSockets.find((s) => s.userName === offerInOffers.offererUserName);
  //     if (socketToSendTo) {
  //       webRtcNamespace.to(socketToSendTo.socketId).emit("receivedIceCandidateFromServer", iceCandidate);
  //     } else {
  //       console.log("Ice candidate received but could not find offerer");
  //     }
  //   }
  //   // console.log(offers)
  // });

  socket.on("sendIceCandidateToSignalingServer", (iceCandidateObj) => {
    const { didIOffer, iceUserName, iceCandidate } = iceCandidateObj;
    console.log(iceCandidate);
    console.log(
      "iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii---------------",
      iceUserName
    );
    console.log("offerssssssssssssss---------------", offers);
    if (didIOffer) {
      // This ice is coming from the offerer. Send to the answerer
      const offerInOffers = offers.find(
        (o) => o.offererUserName === iceUserName
      );
      if (offerInOffers) {
        offerInOffers.offerIceCandidates.push(iceCandidate);

        // 1. When the answerer answers, all existing ice candidates are sent
        // 2. Any candidates that come in after the offer has been answered, will be passed through
        if (offerInOffers.answererUserName) {
          // Pass it through to the other socket
          const socketToSendTo = connectedSockets.find(
            (s) => s.userName === offerInOffers.answererUserName
          );
          if (socketToSendTo) {
            socket
              .to(socketToSendTo.socketId)
              .emit("receivedIceCandidateFromServer", iceCandidate);
          } else {
            console.log("Ice candidate received but could not find answerer");
          }
        }
      }
    } else {
      // This ice is coming from the answerer. Send to the offerer
      const offerInOffers = offers.find(
        (o) => o.answererUserName === iceUserName
      );

      if (offerInOffers) {
        // Check if offerInOffers is defined
        const socketToSendTo = connectedSockets.find(
          (s) => s.userName === offerInOffers.offererUserName
        );
        if (socketToSendTo) {
          socket.to(socketToSendTo.socketId).emit("receivedIceCandidateFromServer", iceCandidate);
        } else {
          console.log("Ice candidate received but could not find offerer");
        }
      } else {
        console.warn("Offer not found for answerer:", iceUserName);
      }
    }
  });

  socket.on("error", (error) => {
    console.error("Error in WebRTC namespace:", error);
  });
});
// #######################################################33
// #######################################################33
// #######################################################33
// #######################################################33
// #######################################################33
// #######################################################33
// #######################################################33
// #######################################################33

// app.use(express.static(__dirname))

// webRtcNamespace.on('connection',(socket)=>{
//   console.log("Someone has connected in webRtcNamespace");

//     // console.log("Someone has connected");
//     const userName = socket.handshake.auth.userName;
//     const password = socket.handshake.auth.password;

//       // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//   // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

//   socket.on("joinRoom", (roomId) => {
//     socket.join(roomId);
//   });

//   socket.on("callRequest", (data) => {
//     const { callerId, recipientId, roomId } = data;
//     console.log("Received call request:", data);

//     webRtcNamespace.to(roomId).emit("logCallerId", { callerId, recipientId });
//   });

//   // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//   // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

//     if(password !== "p"){
//         socket.disconnect(true);
//         return;
//     }
//     connectedSockets.push({
//         socketId: socket.id,
//         userName
//     })

//     //a new client has joined. If there are any offers available,
//     //emit them out
//     if(offers.length){
//         socket.emit('availableOffers',offers);
//     }

//     socket.on('newOffer',newOffer=>{
//         offers.push({
//             offererUserName: userName,
//             offer: newOffer,
//             offerIceCandidates: [],
//             answererUserName: null,
//             answer: null,
//             answererIceCandidates: []
//         })
//         // console.log(newOffer.sdp.slice(50))
//         //send out to all connected sockets EXCEPT the caller
//         socket.broadcast.emit('newOfferAwaiting',offers.slice(-1))
//     })

//     socket.on('newAnswer',(offerObj,ackFunction)=>{
//         console.log(offerObj);
//         //emit this answer (offerObj) back to CLIENT1
//         //in order to do that, we need CLIENT1's socketid
//         const socketToAnswer = connectedSockets.find(s=>s.userName === offerObj.offererUserName)
//         if(!socketToAnswer){
//             console.log("No matching socket")
//             return;
//         }
//         //we found the matching socket, so we can emit to it!
//         const socketIdToAnswer = socketToAnswer.socketId;
//         //we find the offer to update so we can emit it
//         const offerToUpdate = offers.find(o=>o.offererUserName === offerObj.offererUserName)
//         if(!offerToUpdate){
//             console.log("No OfferToUpdate")
//             return;
//         }
//         //send back to the answerer all the iceCandidates we have already collected
//         ackFunction(offerToUpdate.offerIceCandidates);
//         offerToUpdate.answer = offerObj.answer
//         offerToUpdate.answererUserName = userName
//         //socket has a .to() which allows emiting to a "room"
//         //every socket has it's own room
//         socket.to(socketIdToAnswer).emit('answerResponse',offerToUpdate)
//     })

//     socket.on('sendIceCandidateToSignalingServer',iceCandidateObj=>{
//         const { didIOffer, iceUserName, iceCandidate } = iceCandidateObj;
//         // console.log(iceCandidate);
//         if(didIOffer){
//             //this ice is coming from the offerer. Send to the answerer
//             const offerInOffers = offers.find(o=>o.offererUserName === iceUserName);
//             if(offerInOffers){
//                 offerInOffers.offerIceCandidates.push(iceCandidate)
//                 // 1. When the answerer answers, all existing ice candidates are sent
//                 // 2. Any candidates that come in after the offer has been answered, will be passed through
//                 if(offerInOffers.answererUserName){
//                     //pass it through to the other socket
//                     const socketToSendTo = connectedSockets.find(s=>s.userName === offerInOffers.answererUserName);
//                     if(socketToSendTo){
//                         socket.to(socketToSendTo.socketId).emit('receivedIceCandidateFromServer',iceCandidate)
//                     }else{
//                         console.log("Ice candidate recieved but could not find answere")
//                     }
//                 }
//             }
//         }else{
//             //this ice is coming from the answerer. Send to the offerer
//             //pass it through to the other socket
//             const offerInOffers = offers.find(o=>o.answererUserName === iceUserName);
//             const socketToSendTo = connectedSockets.find(s=>s.userName === offerInOffers.offererUserName);
//             if(socketToSendTo){
//                 socket.to(socketToSendTo.socketId).emit('receivedIceCandidateFromServer',iceCandidate)
//             }else{
//                 console.log("Ice candidate recieved but could not find offerer")
//             }
//         }
//         // console.log(offers)
//     })

// })

// #######################################################33
// #######################################################33
// #######################################################33
// #######################################################33
// #######################################################33
// #######################################################33
// #######################################################33
// #######################################################33

// Chat event handlers (in chatNamespace)
chatNamespace.on("connection", (socket) => {
  console.log("A user connected in chatNamespace");

  socket.on("join room", (roomId) => {
    socket.join(roomId);
  });

  socket.on("get messages by user IDs", (data) => {
    const outgoing_id = data.outgoingID;
    const incoming_id = data.incomingID;

    const sql = `
            SELECT m.*, 
            COALESCE(t.img, u.img) AS img  -- Select image from therapist or users
            FROM messages m
            LEFT JOIN therapist t ON m.outgoing_msg_id = t.unique_id
            LEFT JOIN users u ON m.outgoing_msg_id = u.unique_id
            WHERE (m.outgoing_msg_id = ? AND m.incoming_msg_id = ?)
            OR (m.outgoing_msg_id = ? AND m.incoming_msg_id = ?)
            ORDER BY m.msg_id ASC;
        `;

    connection.query(
      sql,
      [outgoing_id, incoming_id, incoming_id, outgoing_id],
      (err, results) => {
        if (err) throw err;

        // Convert RowDataPacket objects to plain objects
        const messages = results.map((row) => ({
          msg_id: row.msg_id,
          incoming_msg_id: row.incoming_msg_id,
          outgoing_msg_id: row.outgoing_msg_id,
          msg: row.msg,
          audio: row.audio,
          r_date: row.r_date,
          r_time: row.r_time,
          b: row.b,
          img: row.img, // Include image URL
        }));

        socket.emit("load messages", messages);
      }
    );
  });

  socket.on("formSubmission", (data) => {
    const roomId = data.roomId;
    const outgoingId = data.outgoingId;

    const sql = `
    SELECT img FROM users WHERE unique_id = ?    UNION
    SELECT img FROM therapist WHERE unique_id = ?;
  `;

    connection.query(sql, [outgoingId, outgoingId], (err, results) => {
      if (err) {
        console.error("Error fetching image:", err);
        return;
      }
      if (results.length > 0) {
        data.img = results[0].img; // Add image URL to data
      }

      chatNamespace.to(roomId).emit("new messages", data);
    });
  });

  socket.on("disconnect", () => {
    console.log("user disconnected in chatNamespace");
  });
});
