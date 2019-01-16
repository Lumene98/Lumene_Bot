<?php

use TelegramBot\TelegramBotManager\BotManager;

require __DIR__ . '/vendor/autoload.php';

$bot_username = 'YOUR_BOT_NAME';
try {
  $bot = new BotManager([
    'api_key'      => 'YOUR_API_KEY',
    // (string) Bot username that was defined when creating the bot.
    'bot_username'     => $bot_username,

    // (string) A secret password required to authorise access to the webhook.
    'secret'           => 'super_secret',

    // (array) All options that have to do with the webhook.
    'webhook'          => [
      // (string) URL to the manager PHP file used for setting up the webhook.
      'url'            => '',
      // (string) Path to a self-signed certificate (if necessary).
      //'certificate'     => __DIR__ . '/server.crt',
      // (int) Maximum allowed simultaneous HTTPS connections to the webhook.
      'max_connections' => 20,
      // (array) List the types of updates you want your bot to receive.
      'allowed_updates' => ['message', 'edited_channel_post', 'callback_query'],
    ],


    //(bool) Only allow webhook access from valid Telegram API IPs.
    'validate_request' => true,
    // (array) When using `validate_request`, also allow these IPs.
    'valid_ips'        => [
      '1.2.3.4',         // single
      '192.168.1.0/24',  // CIDR
      '10/8',            // CIDR (short)
      '5.6.*',           // wildcard
      '1.1.1.1-2.2.2.2', // range
    ],

    // (array) Paths where the log files should be put.
    'logging'          => [
      // (string) Log file for all incoming update requests.
      'update' => __DIR__ . '/php-telegram-bot-update.log',
      // (string) Log file for debug purposes.
      'debug'  => __DIR__ . '/php-telegram-bot-debug.log',
      // (string) Log file for all errors.
      'error'  => __DIR__ . '/php-telegram-bot-error.log',
    ],

    // (array) All options that have to do with the limiter.
    'limiter'          => [
      // (bool) Enable or disable the limiter functionality.
      'enabled' => true,
      // (array) Any extra options to pass to the limiter.
      'options' => [
        // (float) Interval between request handles.
        'interval' => 0.5,
      ],
    ],

    // (array) An array of user ids that have admin access to your bot (must be integers).
    'admins'           => [
      YOUR_USER_ID,
    ],

    // (array) Mysql credentials to connect a database (necessary for [`getUpdates`](#using-getupdates-method) method!).
    'mysql'            => [
      'host'     => 'localhost',
      'user'     => '',
      'password' => '',
      'database' => '',
    ],
    // (array) All options that have to do with commands.
    'commands'         => [
      // (array) A list of custom commands paths.
      'paths'   => [
        __DIR__ . '/Commands',
      ],
    ],

  ]);
  $bot->run();
} catch (Exception $e) {
  echo $e->getMessage() . PHP_EOL;
}
