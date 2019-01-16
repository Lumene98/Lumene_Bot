<?php


namespace Longman\TelegramBot\Commands\UserCommands;
use Longman\TelegramBot\Commands\Command;
use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Request;

class InsultCommand extends UserCommand
{
    protected $name = 'insult';                      // Your command's name
    protected $description = 'Insult a user'; // Your command description
    protected $usage = '/insult';                    // Usage of your command
    protected $version = '1.0.0';                  // Version of your command

    public function execute()
    {
        $message = $this->getMessage();

        $chat_id = $message->getChat()->getId();
        $message_id = $message->getMessageId();

        $insult = insult();
        $data = [
            'chat_id' => $chat_id,
            'text'    => $insult,
            'reply_to_message_id' => $message_id,
        ];

        return Request::sendMessage($data);        // Send message!
    }

    public function insult()
    {
      return file_get_contents('https://insult.mattbas.org/api/insult');
    }
}
