<?php

require_once __DIR__ . '/vendor/autoload.php';

use Predis\Client;

// Connection settings for Redis
$redis = new Client([
    'scheme' => 'tcp',
    'host'   => '127.0.0.1',
    'port'   => 6379,
]);

// Send a task to the queue (e.g., an email sending request)
$task = json_encode(['to' => 'recipient@example.com', 'subject' => 'Test Email', 'message' => 'Hello, World!']);
$redis->lpush('task_queue', $task);

echo " [x] Sent 'Email Sending Request'\n";
