var express = require('express');
var app = express();
app.use(express.static("./public"));
var server = require('http').createServer(app);
const wss = new WebSocket.Server({ server });
server.listen(3001);