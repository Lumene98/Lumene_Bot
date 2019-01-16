<?php


namespace Longman\TelegramBot\Commands\UserCommands;
use Longman\TelegramBot\Commands\Command;
use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Request;

class DefineCommand extends UserCommand
{
    protected $name = 'define';                      // Your command's name
    protected $description = 'A command to use urbandictionary.com definer, you can use /define -random to get a random word'; // Your command description
    protected $usage = '/define';                    // Usage of your command
    protected $version = '2.0.0';                  // Version of your command

    public function execute()
    {
        $message = $this->getMessage();            // Get Message object

        $chat_id = $message->getChat()->getId();   // Get the current Chat ID

        if (!$message->getChat()->isPrivateChat()) {
          $data['reply_to_message_id'] = $message->getMessageId();
        }

        $data['chat_id'] = $chat_id;
        $text =  $message->getText(true);
        $def = json_decode(file_get_contents('http://api.urbandictionary.com/v0/define?term='. $text), true);
        if($text == '-random'){
          $def = json_decode(file_get_contents('http://api.urbandictionary.com/v0/random'), true);
        }
        if($def['list'] != null){
          $data['text'] .= PHP_EOL  . '*Word*: ' . PHP_EOL . $def['list'][0]['word'] . PHP_EOL . PHP_EOL;
          foreach ($def['tags'] as $value) {
            $data['text'] .= ' #'. preg_replace('/\s+/', '', $value);
          }
          $data['text'] .= PHP_EOL .  PHP_EOL . '*Definition*: ' . PHP_EOL . $def['list'][0]['definition'] . PHP_EOL . PHP_EOL;
          $data['text'] .= $def['list'][0]['example'] != "" ? '*Examples*: '. PHP_EOL .  $def['list'][0]['example'] . PHP_EOL . PHP_EOL: "" . PHP_EOL . PHP_EOL;
          $data['text'] .= $def['list'][0]['thumbs_up'] . ' 👍    ' . $def['list'][0]['thumbs_down'] . ' 👎 ' . PHP_EOL . PHP_EOL;
          $data['text'] .= '_Written by_   *' . $def['list'][0]['author'] . '*   _On_   *' . date('F m, o', strtotime($def['list'][0]['written_on'])) . '*';
        }
        else{
          $data['text'] = '*Word not found ¯\_(ツ)_/¯*' . PHP_EOL . 'If you want to add this word you can click this [link](https://www.urbandictionary.com/add.php)';
        }
        $data['parse_mode'] = 'Markdown';
        return Request::sendMessage($data);        // Send message!
    }
}
