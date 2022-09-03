const WebSocket = require("ws").Server;
const HttpsServer = require('http').createServer;
const fs = require("fs");

server = HttpsServer({
    cert: fs.readFileSync('velo.vn.cert'),
    key: fs.readFileSync('velo.vn.key')
})
socket = new WebSocket({
    server: server
});

server.listen('1337');

socket.on();