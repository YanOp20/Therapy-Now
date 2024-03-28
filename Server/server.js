const express = require('express');
const app = express();
const http = require('http');
const server = http.createServer(app);
const { Server } = require('socket.io');
const cors = require('cors');
const mysql = require('mysql');


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

// Enable CORS for all origins (for simplicity in this example)
app.use(cors());

const io = new Server(server, {
  cors: {
    origin: 'http://localhost', // Replace with your client's origin if different
    // origin: 'http://192.168.100.7', // Replace with your client's origin if different
    // origin: 'http://172.22.181.211', // Replace with your client's origin if different
    methods: ['GET', 'POST'],
  },
});

io.on('connection', (socket) => {
  console.log('A user connected');

  // ... other event handlers
  socket.on('join room', (roomId) => {
    socket.join(roomId);
    console.log(`User joined room: ${roomId}`);
  });
  
  socket.on('get messages by user IDs', (data) => {
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
            b: row.b
          };
          });
          
          socket.emit('load messages', messages); // Send messages back to the client
          // console.log(messages);
        });
  });

  
  
  socket.on('formSubmission', (data) => {
    // console.log(data)
    const roomId = data.roomId;
    // Broadcast the new message to all clients in the room
    io.to(roomId).emit('new messages', data);
  });
  
  socket.on('disconnect', () => {
    console.log('user disconnected');
  });
});


server.listen(4000, '0.0.0.0', () => {
  console.log('Server listening on port 4000');
});