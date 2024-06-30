<!DOCTYPE html>
<html>
<head>
  <title>Chat</title>
  <script src="https://cdn.socket.io/4.5.4/socket.io.min.js"></script>
  <!-- <script src="./Server/socket.io.min.js"></script> -->
</head>
<body>
  <h1>Chat</h1>

  <script>
    const socket = io('http://localhost:4000'); // Assuming server.js is running on port 3000

    socket.on('connect', () => {
      console.log('Connected to server');
    });

    // Handle incoming messages and events here
  </script>
</body>
</html>