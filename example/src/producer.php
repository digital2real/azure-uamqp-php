<?php

use Azure\uAMQP\Message;

include_once __DIR__ . '/parameters.php';

$connection = include __DIR__ . '/connection.php';

$message = new Message(MY_MESSAGE);

$message->setProperty('message_id', '12345');
$message->setProperty('to', 'to_example');
$message->setProperty('subject', 'subject_example');
$message->setProperty('reply_to', 'reply_to_example');
$message->setProperty('correlation_id', '12345');
$message->setProperty('content_type', 'content_type_example');
$message->setProperty('content_encoding', 'content_encoding_example');
// $message->setProperty('absolute_expiry_time', time()*1000 + 60 * 1000);
$message->setProperty('creation_time', time()*1000);
$message->setProperty('group_id', 'group_id_example');
$message->setProperty('reply_to_group_id', 'reply_to_group_id_example');

$message->setApplicationProperty('some-application-property', 'S', 'some value');
$message->setApplicationProperty('someId', 'S', '12345');

// $message->setMessageAnnotation('some-application-annotation', 'S', 'some annotation');
try {
    $connection->publish(MY_TOPIC, $message);
} catch (\Exception $e) {
    echo $e->getMessage();
}
