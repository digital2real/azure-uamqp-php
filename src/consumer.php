<?php

use Azure\uAMQP\Message;
use Azure\uAMQP\Connection;

include_once __DIR__ . '/parameters.php';
$connection = new Connection(HOST, PORT, USE_TLS, KEY_NAME, ACCESS_KEY, false, TIMEOUT);
try {
    $nOfMessages = 0;
    $connection->setCallback(
        MY_SUBSCRIPTION,
        function (Message $message) use (&$nOfMessages) {
            $nOfMessages++;
            echo $message->getBody(), PHP_EOL;

            var_dump($message->getProperty('message_id'));
            var_dump($message->getProperty('to'));
            var_dump($message->getProperty('subject'));
            var_dump($message->getProperty('reply_to'));
            var_dump($message->getProperty('correlation_id'));
            var_dump($message->getProperty('content_type'));
            var_dump($message->getProperty('content_encoding'));
            var_dump($message->getProperty('absolute_expiry_time'));
            var_dump($message->getProperty('creation_time'));
            var_dump($message->getProperty('group_id'));
            var_dump($message->getProperty('reply_to_group_id'));
            var_dump($message->getApplicationProperties());

            echo PHP_EOL . 'n = ' . $nOfMessages . '; memory_get_usage = ' . memory_get_usage() . ' bytes' . PHP_EOL;
        },
        function () use (&$nOfMessages, $connection) {
            while ($nOfMessages < 1) {
                $connection->consume();
                time_nanosleep(0, 100000000);
            }
        },
        //"someId='12345'" // select messages with some-id Application Property equals 12345
        "" // enter an empty string if you want to get all messages
    );

    $connection->close();
} catch (\Exception $e) {
    echo $e->getMessage();
}
