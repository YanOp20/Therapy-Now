const fs = require('fs'),
    https = require('https'),
    express = require('express'),
    socketio = require('socket.io'),
    mysql = require('mysql'),
    os = require('os'),
    path = require('path');
    //  cors = require('cors');
const app = express();

// Define the directory for your static files
const staticDirectory = path.join(__dirname, '../javascript/webrtc');

// Tell Express to serve static files from the specified directory
app.use(express.static(staticDirectory));

//   geting hostname
const networkInterfaces = os.networkInterfaces();
let ipAddresses = [];
for (const name of Object.keys(networkInterfaces)) {
    for (const net of networkInterfaces[name]) {
        // Skip over non-IPv4 and internal (i.e. 127.0.0.1) addresses
        if (net.family === 'IPv4' && !net.internal) {
            ipAddresses.push(net.address);
        }
    }
}
// const host = "https://localhost"
const host = `https://${ipAddresses[0]}` 
const port = 4000
// Load HTTPS key and certificate
//we need a key and cert to run https
//we generated them with mkcert
// $ mkcert create-ca
// $ mkcert create-cert
const key = fs.readFileSync('cert.key');
const cert = fs.readFileSync('cert.crt');

// HTTPS configuration
const httpsServer = https.createServer({ key, cert }, app);

// Socket.io configuration
const io = socketio(httpsServer, {
    cors: {
        origin: [
           host,
        ],
        methods: ["GET", "POST"]
    }
});
// Namespaces
const webrtcNamespace = io.of('/webrtc');
const chatNamespace = io.of('/chat');

// Database  connection
const connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'therapy'
});
connection.connect((err) => {
    if (err) throw err;
    console.log('Connected to MySQL database');
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
]

//create our socket.io server... it will listen to our express port
// WebRTC signaling event handlers (in webrtcNamespace)
webrtcNamespace.on('connection', (socket) => { 
        console.log("Someone has connected in webrtcNamespace");
        const userName = socket.handshake.auth.userName;
        const password = socket.handshake.auth.password;
    
        if(password !== "x"){
            socket.disconnect(true);
            return;
        }
        connectedSockets.push({
            socketId: socket.id,
            userName
        })
    
        //a new client has joined. If there are any offers available,
        //emit them out
        if(offers.length){
            socket.emit('availableOffers',offers);
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
            socket.broadcast.emit('newOfferAwaiting',offers.slice(-1))
        })
    
        socket.on('newAnswer',(offerObj,ackFunction)=>{
            console.log(offerObj);
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
            socket.to(socketIdToAnswer).emit('answerResponse',offerToUpdate)
        })
    
        socket.on('sendIceCandidateToSignalingServer',iceCandidateObj=>{
            const { didIOffer, iceUserName, iceCandidate } = iceCandidateObj;
            // console.log(iceCandidate);
            if(didIOffer){
                //this ice is coming from the offerer. Send to the answerer
                const offerInOffers = offers.find(o=>o.offererUserName === iceUserName);
                if(offerInOffers){
                    offerInOffers.offerIceCandidates.push(iceCandidate)
                    // 1. When the answerer answers, all existing ice candidates are sent
                    // 2. Any candidates that come in after the offer has been answered, will be passed through
                    if(offerInOffers.answererUserName){
                        //pass it through to the other socket
                        const socketToSendTo = connectedSockets.find(s=>s.userName === offerInOffers.answererUserName);
                        if(socketToSendTo){
                            socket.to(socketToSendTo.socketId).emit('receivedIceCandidateFromServer',iceCandidate)
                        }else{
                            console.log("Ice candidate recieved but could not find answere")
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
                    console.log("Ice candidate recieved but could not find offerer")
                }
            }
            // console.log(offers)
        })    
 });

// Chat event handlers (in chatNamespace)
chatNamespace.on('connection', (socket) => { 
    console.log("A user connected in chatNamespace");

    // ... other event handlers
    socket.on("join room", (roomId) => {
      socket.join(roomId);
      console.log(`User joined room: ${roomId}`);
    });
  
    socket.on("get messages by user IDs", (data) => {
      const outgoing_id = data.ogi;
      const incoming_id = data.ici;
  
      const sql = `
      SELECT * FROM messages
      WHERE (outgoing_msg_id = ${outgoing_id} AND incoming_msg_id = ${incoming_id})
      OR (outgoing_msg_id = ${incoming_id} AND incoming_msg_id = ${outgoing_id})
      ORDER BY messages.msg_id ASC
      `;
  
      connection.query(sql, (err, results) => {
        if (err) throw err;
  
        // Convert RowDataPacket objects to plain objects
        const messages = results.map((row) => {
          return {
            msg_id: row.msg_id,
            incoming_msg_id: row.incoming_msg_id,
            outgoing_msg_id: row.outgoing_msg_id,
            msg: row.msg,
            audio: row.audio,
            r_date: row.r_date,
            r_time: row.r_time,
            b: row.b,
          };
        });
  
        socket.emit("load messages", messages); // Send messages back to the client
        // console.log(messages);
      });
    });
  
    socket.on("formSubmission", (data) => {
      const roomId = data.roomId;
      // Broadcast the new message to all clients in the room
      io.to(roomId).emit("new messages", { data });
      console.log(data)
    });
  
    socket.on("disconnect", () => {
      console.log("user disconnected in chatNamespace");
    });
 });


httpsServer.listen(port, () => {
    console.log(`Merged server running on - ${host+':'+port}`);
});