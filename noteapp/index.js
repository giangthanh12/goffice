var express = require('express');
var app = express();
app.use(express.static("./public"));
var server = require('http').Server(app);
const WebSocket = require('ws');
const wss = new WebSocket.Server({ server:server });
wss.on('connection', function connection(ws) {
  console.log('ok');
    // ws.on('message', function message(data) {
    //   console.log('received: %s', data);
    //   ws.send(data);
    // });
  
    
  });
server.listen(3001);
//biến socket quản lý kết nối người a
