const fs = require("fs"),
  https = require("https"),
  express = require("express"),
  socketIo = require("socket.io"),
  mysql = require("mysql"),
  os = require("os"),
  path = require("path"),
  app = express();
const { count, table } = require("console");
  const cors = require('cors');

// const staticDirectory = path.join(__dirname, "../javascript/webRtc");
// app.use(express.static(staticDirectory));
app.use(cors());


const networkInterfaces = os.networkInterfaces();
let ipAddresses = [];
for (const name of Object.keys(networkInterfaces)) {
  for (const net of networkInterfaces[name]) {// Skip over non-IPv4 and internal (i.e. 127.0.0.1) addresses
      if (net.family === "IPv4" && !net.internal) ipAddresses.push(net.address);
  }
}
let ipAddressess = (typeof ipAddresses[2] !== 'undefined') ? ipAddresses[2] : ipAddresses[0];

const host = `https://${ipAddressess}`;
const port = 3000;

app.get('/', (req, res) => {  res.redirect(`${host}/therapy-now`); });

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
const io = socketIo(httpsServer, {  cors: { origin: "*",  methods: ["GET", "POST"]  } });

httpsServer.listen(port, () => {  console.log(`server running on - ${host + ":" + port}`);});

// Namespaces
const webRtcNamespace = io.of("/webRtc");
const chatNamespace = io.of("/chat");

// Database  connection
const connection = mysql.createConnection({  host: "localhost",  user: "root",  password: "",  database: "therapy",});
connection.connect((err) => {  if (err) throw err;  console.log("Connected to MySQL database");});

function countRows(connection, table, condition = "") {
  return new Promise((resolve, reject) => {
    const sql = `SELECT COUNT(*) AS total_rows FROM ${table} ${condition}`;
    connection.query(sql, (err, result) => {
      if (err) {
        reject(err);
      } else {
        if (result.length > -1) {
          resolve(result[0].total_rows);
        } else {
          resolve(0);
        }
      }
    });
  });
}

// countRows(connection, 'users', ' WHERE status = \'Active now\'').then( a => console.log(a)).catch((e) => {console.log(e);})


function fetchData(connection, table, condition = "") {
  return new Promise((resolve, reject) => {
      const sql = `SELECT * FROM ${table} ${condition}`;
      connection.query(sql, (err, result) => {
          if (err) {
              reject(err);
          } else {
              resolve(result);
          }
      });
  });
}

// <form method="post" autocomplete="off">
//   <input type="hidden" name="remove" value="${user.unique_id}">
//   <button type="submit">Remove</button>
// </form>

function displayUsers(users, t = "") {
  return users.map(user => `
    <div>
      <img src="php/images/${user.img}" alt="img">
      <p>${user.fname} ${user.lname}</p>
      ${t === 'therapist' ? `
        <div class="remove-button">
            <button data-id="${user.unique_id}">Remove</button> 
        </div>
      ` : ''}
    </div>
  `).join('');
}


function displaySchedules(schedules, users, therapists) {
  // Sort schedules by date and time
  schedules.sort((a, b) => {
    // Compare dates first
    const dateA = new Date(a.date);
    const dateB = new Date(b.date);
    if (dateA < dateB) {
      return -1;
    } else if (dateA > dateB) {
      return 1;
    } else { // Dates are equal, so compare times
      const timeA = new Date(`1970-01-01T${a.start_time}`);
      const timeB = new Date(`1970-01-01T${b.start_time}`);
      return timeA - timeB;
    }
  });

  // Rest of the code remains the same
  return schedules.map(s => {
    const user = users.find(u => u.unique_id === s.user_id);
    const therapist = therapists.find(t => t.unique_id === s.therapist_id);

    const startTime = new Date(`1970-01-01T${s.start_time}`);
    const endTime = new Date(`1970-01-01T${s.end_time}`);
    const startTimeAMPM = startTime.toLocaleTimeString('en-US', {hour: 'numeric', minute: 'numeric', hour12: true});
    const endTimeAMPM = endTime.toLocaleTimeString('en-US', {hour: 'numeric', minute: 'numeric', hour12: true});
    const formattedDate = new Date(s.date).toLocaleDateString();

    return `
      <div class='row-schedule'>
        <div class='users-img-name'>
          <img src='php/images/${user.img}' alt='img'>
          <p>${user.fname} ${user.lname}</p>
        </div>
        <div class='date'><span>${formattedDate}</span></div>
        <div class='time'><span>${startTimeAMPM} - ${endTimeAMPM}</span></div>
        <div class='therapist-img-name'>
          <img src='php/images/${therapist.img}' alt='img'>
          <p>${therapist.fname} ${therapist.lname}</p>
        </div>
      </div>
    `;
  }).join(''); 
}

//offers will contain {}
// const offers = [  // offererUserName  // offer  // offerIceCandidates  // answererUserName  // answer  // answererIceCandidates
let offers = [  // offererUserName  // offer  // offerIceCandidates  // answererUserName  // answer  // answererIceCandidates
  ];

const connectedSockets = [  //username, socketId
];
 
  webRtcNamespace.on('connection',(socket)=>{
    console.log("Someone has connected to wbtcNamespace: " );

    const userName = socket.handshake.auth.userName;
    const roomId = socket.handshake.auth.roomId;

    // ###########################################################
    // ###########################################################

    socket.join(roomId);
    socket.on('rtcRoom', roomId => {})



    connectedSockets.push({socketId: socket.id, userName, roomId})

    socket.on('calling', c => {
      webRtcNamespace.to(roomId).emit('receivedCall', c)
    });




      // ###########################################################
    // ###########################################################

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
        // offers[0] = {
        //   offererUserName: userName,
        //   offer: newOffer,
        //   offerIceCandidates: [], 
        //   answererUserName: null,
        //   answer: null,
        //   answererIceCandidates: []
        // };
        // console.log(newOffer.sdp.slice(50))
        //send out to all connected sockets EXCEPT the caller
        // socket.broadcast.emit('newOfferAwaiting',offers.slice(-1))
        socket.to(roomId).emit('newOfferAwaiting',offers.slice(-1))
    })

    socket.on('answerBtnClicked' ,(c) =>{
      // console.log(c)
      webRtcNamespace.to(roomId).emit('answerBtnClicked2',c);
    })


    socket.on('newAnswer',(offerObj,ackFunction)=>{
        // console.log("offerObj: ",offerObj);
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
    // Inside webRtcNamespace.on('connection', ...)
// ... (Your existing code) ...


// Inside webRtcNamespace.on('connection', ...)
const handleCallEnd = (userName, roomId) => {
    socket.to(roomId).emit('callEnded'); // Notify other user
    const offerIndex = offers.findIndex(offer => 
        (offer.offererUserName === userName && offer.roomId === roomId) || 
        (offer.answererUserName === userName && offer.roomId === roomId)
    );
    if (offerIndex > -1) offers.splice(offerIndex, 1);
};

socket.on('declineCall', ({ userName, roomId, callerSocketId }) => {
    // console.log("Call declined.");
    webRtcNamespace.to(callerSocketId).emit('callDeclined', { reason: 'User declined the call' });
    handleCallEnd(userName, roomId);
});

socket.on('userDisconnected', (roomId, callerSocketId) => {
    // console.log("User disconnected.");
    handleCallEnd(socket.handshake.auth.userName, roomId); // Use userName from socket
});

// ... (Your existing code) ...


})

// Chat event handlers (in chatNamespace)
chatNamespace.on("connection", (socket) => {
  console.log("A user connected in chatNamespace");
  socket.on('error', error => console.error('Socket error:', error));
  socket.on("join room", roomId => socket.join(roomId));

  socket.on("login logout", r => {
    (async () => {
      try {
        // console.log(r)
        const countOnlineClients = await countRows(connection, 'users', ' WHERE status = \'Active now\'');
        const countOnlineTherapist = await countRows(connection, 'therapist', ' WHERE status = \'Active now\'');
        const onlineClients = displayUsers(await fetchData(connection, 'users', ' WHERE status = \'Active now\''));
        const onlineTherapist = displayUsers(await fetchData(connection, 'therapist', ' WHERE status = \'Active now\''));
        const allClients = displayUsers(await fetchData(connection, 'users'));
        const countAllClient = await countRows(connection, 'users');

        const change = {
          count_online_clients: countOnlineClients,
          online_clients: onlineClients,
          count_online_therapist: countOnlineTherapist,
          online_therapist: onlineTherapist,
          allClients: allClients,
          count_all_client: countAllClient
        }
        socket.broadcast.emit('login logout change', change);
      } catch (err) {
        console.error('Error:', err);
      }
    })();    
  });
  socket.on("schedule", r => {
    (async () => {
      try {
        // console.log(r)
        const schedules = await fetchData(connection, 'appointment');
        const users = await fetchData(connection, 'users');
        const therapist = await fetchData(connection, 'therapist');
        const scheduleHTML = displaySchedules(schedules, users, therapist);        
        
        // console.log(scheduleHTML)
        socket.broadcast.emit('schedule change', scheduleHTML);
      } catch (err) {
        console.error('Error:', err);
      }
    })();    
  });

  socket.on("add remove therapist", r => {
    (async () => {
      try {
        // console.log(r)
        const countAllTherapists = await countRows(connection, 'therapist');
        const therapist = displayUsers( await fetchData(connection, 'therapist'));
        const r_therapist = displayUsers( await fetchData(connection, 'therapist'), 'therapist');

        const onlineTherapist = displayUsers(await fetchData(connection, 'therapist', ' WHERE status = \'Active now\''));
        const countOnlineTherapist = await countRows(connection, 'therapist', ' WHERE status = \'Active now\'');

        const change = {
          therapist: therapist,
          all_therapist: countAllTherapists,
          r_therapist: r_therapist,
          count_online_therapist: countOnlineTherapist,
          online_therapist: onlineTherapist
        }
        // console.log(change);
        socket.emit('add remove therapist change', change);
      } catch (err) {
        console.error('Error:', err);
      }
    })();    
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

  socket.on("disconnect", () => console.log("user disconnected in chatNamespace"));
});
