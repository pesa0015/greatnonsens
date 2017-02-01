// var express = require('express'),
//     http = require('http');
// var app = express();
// var server = http.createServer(app);

// server.listen(3000, '127.0.0.1');

// var socket  = require( './public/node_modules/socket.io' );
// var express = require('./public/node_modules/express');
var socket  = require('socket.io');
var express = require('express');
var app     = express();
var server  = require('http').createServer(app);
var io      = socket.listen( server );
var port    = process.env.PORT || 3000;

server.listen(port, function () {
  console.log('Server listening at port %d', port);
});


io.on('connection', function (socket) {
  socket.on('test', function(data){
    console.log(data);
    io.sockets.emit('test2', Date.now())
  });
  socket.on( 'new_count_message', function( data ) {
    io.sockets.emit( 'new_count_message', { 
    	new_count_message: data.new_count_message

    });
  });

  socket.on( 'update_count_message', function( data ) {
    io.sockets.emit( 'update_count_message', {
    	update_count_message: data.update_count_message 
    });
  });

  socket.on( 'new_message', function( data ) {
    io.sockets.emit( 'new_message', {
    	name: data.name,
    	email: data.email,
    	subject: data.subject,
    	created_at: data.created_at,
    	id: data.id
    });
  });

  
});