<?php

require_once __DIR__ . '/vendor/autoload.php';
use Channel\Client;
use Workerman\Worker;

//  建立websocket server
$worker = new Worker("websocket://127.0.0.1:8005");

$worker->onWorkerStart = function ($worker) {
    Client::connect('127.0.0.1', 8006);
    Client::on('broadcast', function ($event) use ($worker) {
        foreach ($worker->connections as $connection) {
            $connection->send($event);
        }
    });
};

$worker->onMessage = function ($connection, $data) use ($worker) {
    Channel\Client::publish('broadcast', $data);
};

Worker::runAll();
