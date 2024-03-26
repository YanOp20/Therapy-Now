const express = require('express');
const app = express();
const http = require('http');
const server = http.createServer(app);
const { Server } = require('socket.io');
const cors = require('cors');

// Enable CORS for all origins (for simplicity in this example)
app.use(cors());

const io = new Server(server, {
  cors: {
    origin: 'http://localhost', // Replace with your client's origin if different
    methods: ['GET', 'POST'],
  },
});

io.on('connection', (socket) => {
  console.log('A user connected');

  // Handle incoming messages and events here
});

server.listen(3000, () => {
  console.log('Server listening on port 3000');
});