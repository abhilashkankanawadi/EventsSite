var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var redis = require('redis');

server.listen(8888);
io.on('connection', function (socket) {

// Listen to local Redis broadcasts
console.log("new client connected");
var redisClient = redis.createClient();
var redisJoin = redis.createClient(); 

redisClient.subscribe('message1');
redisClient.on("message", function(channel, content) {
  console.log("mew message add in queue "+ content + " channel");
  socket.emit(channel, content);
});

redisJoin.subscribe('chatJoin');
redisJoin.on("check", function(channel, joined) {
  console.log("mew message add in queue "+ joined + " channel");
  socket.emit(channel, joined);
});

socket.on('disconnect', function() {
  redisClient.quit();
    redisJoin.quit();
  });
});
