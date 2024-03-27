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
    methods: ['GET', 'POST'],
  },
});

io.on('connection', (socket) => {
  // ... other event handlers

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

// socket.on('chat message', (data) => {
//     console.log('message:', data);

//     // Check if the message is an audio message
//     if (data.audio) {
//         // Handle audio message (e.g., store audio data)
//         socket.emit('chat message', data); // Send the audio message to the sender
//     } else {
//         // Handle text message (e.g., store in database)
//         socket.emit('chat message', data.msg); // Send the text message to the sender
//     }
// });


// ... (rest of the server-side code)
socket.on('formSubmission', (data) => {
  console.log('Received form data:', data);

  // Extract the audio data URL and message
  const audioDataUrl = data.audioDataUrl;
  const message = data.message;

  // Process the audio data URL and message on the server-side
  // ... (e.g., convert audio to binary buffer, store in file/database, process message)
  socket.emit('new messages', {data})
});
  

  socket.on('disconnect', () => {
      console.log('user disconnected');
  });
});

// socket.on('chat message', (data) => {
//   console.log('message:', data);

//   // Check if the message is an audio message
//   if (data.audio) {
//       // Handle audio message (e.g., store audio data)
//       socket.emit('chat message', data); // Send the audio message to the sender
//   } else {
//       // Handle text message (e.g., store in database)
//       socket.emit('chat message', data.msg); // Send the text message to the sender
//   }
// });



server.listen(4000, () => {
  console.log('Server listening on port 4000');
});