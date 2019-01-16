<?php
/**
 * README
 * This configuration file is intended to run the bot with the getUpdates method.
 * Uncommented parameters must be filled
 *
 * Bash script:
 * $ while true; do ./getUpdatesCLI.php; done
 */
// Load composer
require_once __DIR__ . '/vendor/autoload.php';
// Add you bot's API key and name
$bot_api_key  = 'YOUR_API_KEY';
$bot_username = 'YOUR_BOT_NAME';
// Define all IDs of admin users in this array (leave as empty array if not used)
$admin_users = [
//    123,
];
// Define all paths for your custom commands in this array (leave as empty array if not used)
$commands_paths = [
  __DIR__ . '/Commands',
];
// Enter your MySQL database credentials
$mysql_credentials = [
    'host'     => 'localhost',
    'user'     => '',
    'password' => '',
    'database' => '',
];
try {
    // Create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);
    // Add commands paths containing your custom commands
    $telegram->addCommandsPaths($commands_paths);
    // Enable admin users
    $telegram->enableAdmins($admin_users);
    // Enable MySQL
    $telegram->enableMySql($mysql_credentials);

    $telegram->enableLimiter();
    // Handle telegram getUpdates request
    $server_response = $telegram->handleGetUpdates();
    if ($server_response->isOk()) {
        $update_count = count($server_response->getResult());
        echo date('Y-m-d H:i:s', time()) . ' - Processed ' . $update_count . ' updates';
    } else {
        echo date('Y-m-d H:i:s', time()) . ' - Failed to fetch updates' . PHP_EOL;
        echo $server_response->printError();
    }
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    echo $e->getMessage();
    // Log telegram errors
    Longman\TelegramBot\TelegramLog::error($e);
} catch (Longman\TelegramBot\Exception\TelegramLogException $e) {
    // Catch log initialisation errors
    echo $e->getMessage();
}
