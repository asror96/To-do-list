'use strict';

const Pusher = require('pusher-js');

let pusher = new Pusher('0f0a5b74a44ff8579a69', {
    cluster: 'eu',
    encrypted: true
});

let channel = pusher.subscribe('mychannel');
channel.bind('Backend:', (data) => {
    console.log(data);
});

console.log('Listening for messages...');
