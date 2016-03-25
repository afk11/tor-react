<?php

require "vendor/autoload.php";

$loop = React\EventLoop\Factory::create();


$connector = new \React\SocketClient\TcpConnector($loop);

$connector->create('127.0.0.1', 1234)
    ->then(function (\React\Stream\Stream $socket) {
        $socket->on('data', function ($msg) {
            echo "Server sent data: " . $msg . PHP_EOL;
        });

        echo "say hi!\n";
        $socket->write('say hi!');
    }, function ($e) {
        echo "error!";
        echo $e->getMessage().PHP_EOL;
    });

$loop->run();