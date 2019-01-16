<?php
// Load composer
require __DIR__ . '/vendor/autoload.php';

$bot_api_key  = 'YOUR_API_KEY';
$bot_username = 'YOUR_BOT_NAME';
$hook_url = 'YOUR_HOOK_URL';

try {
    // Create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);

    // Set webhook
    $result = $telegram->setWebhook($hook_url);
    if ($result->isOk()) {
        echo $result->getDescription();
    }
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    // log telegram errors
    // echo $e->getMessage();
}
