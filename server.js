const express = require('express');
const app = express();
const http = require('http');
const server = http.createServer(app);

const io = require("socket.io")(server, {
    cors: { origin: "*"}
});

app.get('/', (req, res) => {
  res.sendFile(__dirname + '/index.html');
});

io.on('connection', (socket) => {
    console.log('start connection');
  socket.on('sendChatToServer', (message) => {
    console.log(message);

    // io.sockets.emit('sendChatToClient', message)
    socket.broadcast.emit('sendChatToClient', message)

  });

  socket.on('disconnect', (socket) => {
    console.log('user disconnect');
  });
});

server.listen(3000, () => {
  console.log('Server is running');
});