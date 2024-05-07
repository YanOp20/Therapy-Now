const fs = require("fs"),
  https = require("https"),
  express = require("express"),
  socketIo = require("socket.io"),
  mysql = require("mysql"),
  os = require("os"),
  path = require("path"),
  app = express();
  const cors = require('cors');

// const staticDirectory = path.join(__dirname, "../javascript/webRtc");
// app.use(express.static(staticDirectory));
app.use(cors());


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
let ipAddressess = (typeof ipAddresses[2] !== 'undefined') ? ipAddresses[2] : ipAddresses[0];

const host = `https://${ipAddressess}`;
const port = 3000;

app.get('/', (req, res) => {
  res.redirect(`${host}/therapy-now`);
});
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
    origin: "*",
    methods: ["GET", "POST"],
  },
});
httpsServer.listen(port, () => {  console.log(`server running on - ${host + ":" + port} and ${host}/therapy-now`);});

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

const connectedSockets = [  //username, socketId
];
 
  webRtcNamespace.on('connection',(socket)=>{
    console.log("Someone has connected to wbtcNamespace: " );

    const userName = socket.handshake.auth.userName;
    const roomId = socket.handshake.auth.roomId;

    // ###########################################################
    // ###########################################################

    socket.on('rtcRoom', roomId => {
      socket.join(roomId);
    })

    socket.on('calling', c => {
      webRtcNamespace.to(roomId).emit('receivedCall', c)
    });



    // ###########################################################
    // ###########################################################

    connectedSockets.push({socketId: socket.id, userName, roomId})
    // console.log('connected', connectedSockets)
    //a new client has joined. If there are any offers available,
    //emit them out
    if(offers.length){
        // socket.emit('availableOffers',offers);
        // socket.to(roomId).emit('availableOffers',offers);
    }
  
    
    socket.on('newOffer',newOffer=>{
        offers.push({
            offererUserName: userName,
            offer: newOffer,
            offerIceCandidates: [],
            answererUserName: null,
            answer: null,
            answererIceCandidates: []
        })
        // console.log(newOffer.sdp.slice(50))
        //send out to all connected sockets EXCEPT the caller
        // socket.broadcast.emit('newOfferAwaiting',offers.slice(-1))
        socket.to(roomId).emit('newOfferAwaiting',offers.slice(-1))
    })

    socket.on('answerBtnClicked' ,(c) =>{
      console.log(c)
      webRtcNamespace.to(roomId).emit('answerBtnClicked2',c);
    })


    socket.on('newAnswer',(offerObj,ackFunction)=>{
        console.log("offerObj: ",offerObj);
        //emit this answer (offerObj) back to CLIENT1
        //in order to do that, we need CLIENT1's socketid
        const socketToAnswer = connectedSockets.find(s=>s.userName === offerObj.offererUserName)
        if(!socketToAnswer){
            console.log("No matching socket")
            return;
        }
        //we found the matching socket, so we can emit to it!
        const socketIdToAnswer = socketToAnswer.socketId;
        //we find the offer to update so we can emit it
        const offerToUpdate = offers.find(o=>o.offererUserName === offerObj.offererUserName)
        if(!offerToUpdate){
            console.log("No OfferToUpdate")
            return;
        }
        //send back to the answerer all the iceCandidates we have already collected
        ackFunction(offerToUpdate.offerIceCandidates);
        offerToUpdate.answer = offerObj.answer
        offerToUpdate.answererUserName = userName
        //socket has a .to() which allows emiting to a "room"
        //every socket has it's own room
        // socket.to(socketIdToAnswer).emit('answerResponse',offerToUpdate)
        socket.to(roomId).emit('answerResponse',offerToUpdate)
    })

    socket.on('sendIceCandidateToSignalingServer',iceCandidateObj=>{
        const { didIOffer, iceUserName, iceCandidate } = iceCandidateObj;
        // console.log(iceCandidate);
        if(didIOffer){
            //this ice is coming from the offerer. Send to the answerer
            const offerInOffers = offers.find( o => o.offererUserName === iceUserName);
            if(offerInOffers){
                offerInOffers.offerIceCandidates.push(iceCandidate)
                // 1. When the answerer answers, all existing ice candidates are sent
                // 2. Any candidates that come in after the offer has been answered, will be passed through
                if(offerInOffers.answererUserName){
                    //pass it through to the other socket
                    const socketToSendTo = connectedSockets.find(s => s.userName === offerInOffers.answererUserName);
                    if(socketToSendTo){
                        socket.to(socketToSendTo.socketId).emit('receivedIceCandidateFromServer',iceCandidate)
                    }else{
                        console.log("Ice candidate received but could not find answere")
                    }
                }
            }
        }else{
            //this ice is coming from the answerer. Send to the offerer
            //pass it through to the other socket
            const offerInOffers = offers.find(o=>o.answererUserName === iceUserName);
            const socketToSendTo = connectedSockets.find(s=>s.userName === offerInOffers.offererUserName);

            if(socketToSendTo){
                socket.to(socketToSendTo.socketId).emit('receivedIceCandidateFromServer',iceCandidate)
            }else{
                console.log("Ice candidate received but could not find offerer")
            }
        }
        // console.log(offers)
    })

})

// Chat event handlers (in chatNamespace)
chatNamespace.on("connection", (socket) => {
  console.log("A user connected in chatNamespace");
  socket.on('error', (error) => {
    console.error('Socket error:', error);
});
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
