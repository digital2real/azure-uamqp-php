<?php

use Azure\uAMQP\Message;
use Azure\uAMQP\Connection;
include_once __DIR__ . '/parameters.php';

for($i = 0; $i < 1; $i++) {

    $connection = new Connection(HOST, PORT, USE_TLS, KEY_NAME, ACCESS_KEY, false, TIMEOUT);

    $message = new Message(MY_MESSAGE);

    $message->setProperty('message_id', '12345');
    $message->setProperty('to', 'to_example');
    $message->setProperty('subject', 'subject_example');
    $message->setProperty('reply_to', 'reply_to_example');
    $message->setProperty('correlation_id', '12345');
    $message->setProperty('content_type', 'content_type_example');
    $message->setProperty('content_encoding', 'content_encoding_example');
    $message->setProperty('absolute_expiry_time', time()*1000 + 60 * 1000);
    $message->setProperty('creation_time', time()*1000);
    $message->setProperty('group_id', 'group_id_example');
    $message->setProperty('reply_to_group_id', 'reply_to_group_id_example');

    $message->setApplicationProperty('some-application-property', 'S', $i. ' = some value');
    $message->setApplicationProperty('some-application-property-2', 'S', $i. ' = some value - 2');

    try {
        $connection->publish(MY_TOPIC, $message);
        $connection->close();
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
    echo PHP_EOL . 'memory_get_usage = ' . memory_get_usage() . ' bytes' . PHP_EOL;
}
