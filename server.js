var socket  = require( 'socket.io' );
var express = require('express');
var app     = express();
var server  = require('http').createServer(app);
var io      = socket.listen( server );
var port    = process.env.PORT || 3000;

server.listen(port, function () {
  console.log('Server listening at port %d', port);
});


io.on('connection', function (socket) {

  socket.on( 'new_notif', function( data ) {
    io.sockets.emit( 'new_notif', {
    	new_unread_notif_count: data.new_unread_notif_count,
      new_notif_desc: data.new_notif_desc,
      new_notif_url: data.new_notif_url,
      new_user_id: data.new_user_id
    });
  });

  socket.on('error', function (err) {
    console.log(err);
  });

});
