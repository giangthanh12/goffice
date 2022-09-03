"use strict";
// Optional. You will see this name in eg. 'ps' or 'top' command
process.title = 'node-chat';
// Port where we'll run the websocket server
var webSocketsServerPort = 1338;
// websocket and http servers
var webSocketServer = require('websocket').server;
var https = require('http');
const {createServer: HttpsServer} = require("http");
const fs = require("fs");
// list of currently connected clients (users)node 
var clients = [];

var server = HttpsServer({
    cert: fs.readFileSync('velo.vn.cert'),
    key: fs.readFileSync('velo.vn.key')
});

server.listen(webSocketsServerPort, function () {
    // console.log((new Date()) + " Server is listening on port "
    //     + webSocketsServerPort);
});
/**
 * WebSocket server
 */
var wsServer = new webSocketServer({
    // WebSocket server is tied to a HTTP server. WebSocket
    // request is just an enhanced HTTP request. For more info
    // http://tools.ietf.org/html/rfc6455#page-6
    httpServer: server
});
// This callback function is called every time someone
// tries to connect to the WebSocket server
var userArr = [];
var path = 'error';
wsServer.on('request', function (request) {
    // console.log((new Date()) + ' Connection from origin '
    //     + request.origin);
    // console.log(request);
    // accept connection - you should check 'request.origin' to
    // make sure that client is connecting from your website
    // (http://en.wikipedia.org/wiki/Same_origin_policy)
    var connection = request.accept(null, request.origin);
    // we need to know client index to remove them on 'close' event
    if(request.resourceURL.pathname!='')
        path = request.resourceURL.pathname.substring(1); // lấy ra mã doanh nghiệp
    var index = clients.push(connection) - 1;
    if (request.resourceURL.query.staffId != null) {
        var str = request.resourceURL.query.staffId;
        if(!userArr[path])
            userArr[path] = [];
        var userindex = userArr[path].length;
         //check tồn Tại user có trong kết nối
         if(!userArr[path].includes(str))   {
            userArr[path][userindex] = str;
         }
        for (var i = 0; i < clients.length; i++) {
            var data = {'path':path,'type': 'user', 'users': unique(userArr[path])};
            clients[i].sendUTF(JSON.stringify(data));
        }
    }
    // user sent some message
    connection.on('message', function (result) {
        // first message sent by user is their name
        // console.log((new Date()) + ' Received Message:' + data);
        // broadcast message to all connected clients
        var data = JSON.parse(result.utf8Data);
        data['path']=path;
        if (data.type == "logout") {
            if(userArr[path]){
                for (var j = 0; j < userArr[path].length; j++) {
                    if (userArr[path][j] == data.userid) {
                        userArr[path].splice(j, 1);
                    }
                }
            }
            var json = {'path':path,'type': 'user', 'users': unique(userArr[path])};
        } else {
            var json = result.utf8Data;
        }

        for (var i = 0; i < clients.length; i++) {
            clients[i].sendUTF(json);
        }
    });
    // user disconnected
    // lắng nghe sự kiện disconnected
    connection.on('close', function (connection) {
        console.log('ok');
        // if (userName !== false && userColor !== false) {
        // console.log((new Date()) + " Peer "
        //     + connection.remoteAddress + " disconnected.");
        // remove user from the list of connected clients
        for (var j = 0; j < userArr[path].length; j++) {
            if (userArr[path][j] == str) {
                userArr[path].splice(j, 1);
                break;
            }
        }
        var data = {'path':path,'type': 'user', 'users': unique(userArr[path])};
        for (var i = 0; i < clients.length; i++) {
            clients[i].sendUTF(JSON.stringify(data));
        }
        clients.splice(index, 1);

        //         // push back user's color to be reused by another user
        //         colors.push(userColor);
        //     }

    });
});
function unique(arr) {
    var newArr = []
    for (var i = 0; i < arr.length; i++) {
        if (newArr.indexOf(arr[i]) === -1) {
            newArr.push(arr[i])
        }
    }
    return newArr
}