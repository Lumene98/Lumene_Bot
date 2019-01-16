<?php
/**
 * README
 * This configuration file is intended to run a list of commands with crontab.
 * Uncommented parameters must be filled
 */
// Your command(s) to run, pass it just like in a message (arguments supported)
$commands = [
];
// Load composer
require_once __DIR__ . '/vendor/autoload.php';
// Add you bot's API key and name
$bot_api_key  = 'YOUR_API_KEY';
$bot_username = 'YOUR_BOT_NAME';
// Define all IDs of admin users in this array (leave as empty array if not used)
$admin_users = [
];
// Define all paths for your custom commands in this array (leave as empty array if not used)
$commands_paths = [
    __DIR__ . '/Commands',
];

try {
    // Create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);
    // Add commands paths containing your custom commands
    $telegram->addCommandsPaths($commands_paths);
    // Enable admin users
    $telegram->enableAdmins($admin_users);

    $telegram->enableLimiter();
    // Run user selected commands
    $telegram->runCommands($commands);
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    // Silence is golden!
    //echo $e;
    // Log telegram errors
    Longman\TelegramBot\TelegramLog::error($e);
} catch (Longman\TelegramBot\Exception\TelegramLogException $e) {
    // Silence is golden!
    // Uncomment this to catch log initialisation errors
    //echo $e;
}
