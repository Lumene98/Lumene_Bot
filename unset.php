<?php

// Load composer
require_once __DIR__ . '/vendor/autoload.php';
// Add you bot's API key and name
$bot_api_key  = 'YOUR_API_KEY';
$bot_username = 'YOUR_BOT_NAME';
try {
    // Create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);
    // Delete webhook
    $result = $telegram->deleteWebhook();
    if ($result->isOk()) {
        echo $result->getDescription();
    }
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    echo $e->getMessage();
}
