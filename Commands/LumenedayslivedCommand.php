<?php


namespace Longman\TelegramBot\Commands\UserCommands;
use Longman\TelegramBot\Commands\Command;
use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Request;

class LumenedayslivedCommand extends UserCommand
{
    protected $name = 'lumenedayslived';                      // Your command's name
    protected $description = 'A command to get the days Lumene lived'; // Your command description
    protected $usage = '/lumenedayslived';                    // Usage of your command
    protected $version = '1.0.0';                  // Version of your command

    public function execute()
    {
        $message = $this->getMessage();            // Get Message object

        $chat_id = $message->getChat()->getId();
        $user_id = $message->getFrom()->getId();
        $message_id = $message->getMessageId();
        $days = $this->calculateDays();
        $data = [                                  // Set up the new message data
            'chat_id' => $chat_id,                 // Set Chat ID to send the message to
            'reply_to_message_id' => $message_id,
            'text'    => 'Lumene has been "alive" for ' . $days . ' days...', // Set message to send
        ];

        return Request::sendMessage($data);        // Send message!
    }

    private function calculateDays(){
      $now = time();
      $lumene_birth = strtotime("1998-01-03");
      $datediff = $now - $lumene_birth;

      return round($datediff / (60 * 60 * 24));
    }
}
