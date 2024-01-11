<?php

require_once __DIR__ . '/vendor/autoload.php';

use Predis\Client;

// Connection settings for Redis
$redis = new Client([
    'scheme' => 'tcp',
    'host'   => '127.0.0.1',
    'port'   => 6379,
]);

echo " [*] Waiting for messages. To exit, press CTRL+C\n";

// Define the callback function to process the task
$callback = function () use ($redis) {
    // Retrieve a task from the queue
    $task = $redis->brpop('task_queue', 0)[1];

    $taskData = json_decode($task, true);

    // Simulate processing (e.g., sending an email)
    echo " [x] Received 'Email Sending Request': To={$taskData['to']}, Subject={$taskData['subject']}\n";
    // Perform actual processing here (e.g., send email)
};

// Keep the worker running
while (true) {
    $callback();
}

