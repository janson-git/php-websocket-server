<?php

// Это пример того, как можно отправлять сообщения через сокеты клиентам,
// используя ZMQ сокеты. Можно сделать этакий Sender на стороне приложения,
// который будет отправлять запакованые сообщения пуш-серверу, а тот - клиентам.

require __DIR__ . '/vendor/autoload.php';

$entryData = [
    'category' => \App\Categories::NEW_POST,
    'title'    => 'Title Here',
    'article'  => 'Some text data will be here',
    'when'     => time()
];

$context = new ZMQContext();
$socket = $context->getSocket(ZMQ::SOCKET_PUSH, 'my pusher');
$socket->connect("tcp://localhost:5555");

$socket->send(json_encode($entryData));
