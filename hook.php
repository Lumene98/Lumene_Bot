<?php
// Load composer
require __DIR__ . '/vendor/autoload.php';

$bot_api_key  = 'YOUR_API_KEY';
$bot_username = 'YOUR_BOT_NAME';

$commands_paths = [
    __DIR__ . '/Commands',
];

try {
    // Create Telegram API object
    // Create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);
    // Add commands paths containing your custom commands
    $telegram->addCommandsPaths($commands_paths);

    $telegram->enableLimiter();
    // Handle telegram webhook request
    $telegram->handle();
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    // Silence is golden!
    // log telegram errors
    // echo $e->getMessage();
}
