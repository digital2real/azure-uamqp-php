<?php

use Azure\uAMQP\Message;

include_once __DIR__ . '/parameters.php';

$connection = include __DIR__ . '/connection.php';

$message = new Message(MY_MESSAGE);
$message->setApplicationProperty('some-application-property', 'S', 'some value');
$message->setMessageAnnotation('x-opt-scheduled-enqueue-time', 'T', (time() + 5)*1000);

$connection->publish(MY_TOPIC, $message);
