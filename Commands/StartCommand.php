<?php
namespace Longman\TelegramBot\Commands\SystemCommands;
use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Request;
/**
* Start command
*
* Gets executed when a user first starts using the bot.
*/
class StartCommand extends SystemCommand
{
  /**
  * @var string
  */
  protected $name = 'start';
  /**
  * @var string
  */
  protected $description = 'Start command';
  /**
  * @var string
  */
  protected $usage = '/start';
  /**
  * @var string
  */
  protected $version = '1.1.0';
  /**
  * @var bool
  */
  protected $private_only = false;
  /**
  * Command execute method
  *
  * @return \Longman\TelegramBot\Entities\ServerResponse
  * @throws \Longman\TelegramBot\Exception\TelegramException
  */
  public function execute()
  {
    $message = $this->getMessage();
    $chat_id = $message->getChat()->getId();
    $user_id = $message->getFrom()->getId();
    $data = [
      'chat_id' => $chat_id,
      'text'    => 'What up, dawggie?' . PHP_EOL . 'Type /help to see all commands!',
    ];

    if ($this->telegram->isAdmin($user_id)) {
      $data['text'] = "Hey Daddy";
    }
    return Request::sendMessage($data);
  }
}
