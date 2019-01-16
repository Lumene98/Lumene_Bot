<?php


namespace Longman\TelegramBot\Commands\UserCommands;
use Longman\TelegramBot\Commands\Command;
use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Request;

class YtdCommand extends UserCommand
{
  protected $name = 'ytd';                      // Your command's name
  protected $description = 'Download a video from youtube'; // Your command description
  protected $usage = '/ytd';                    // Usage of your command
  protected $version = '1.2.0';                  // Version of your command

  public function execute()
  {
    $message = $this->getMessage();

    $chat_id = $message->getChat()->getId();

    if (!$message->getChat()->isPrivateChat()) {
      $data['reply_to_message_id'] = $message->getMessageId();
    }

    $data['chat_id'] = $chat_id;
    $text = $message->getText(true);

    $test = preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $text, $match);
    if($test === 0){
      $data['text'] = 'Invalid Url';
      if($text != "")
      $data['text'] .= ': ' . $text;
    }
    else{
      $result = json_decode(file_get_contents('https://api.unblockvideos.com/youtube_downloader?id=' . $match[1] . '&selector=mp4'), true);
      if(!empty($result)){
        $data['text'] = 'Open this [link](' . $result['0']['url'] . ') and dowload the video from browser';
        $data['parse_mode'] = 'Markdown';
      }
      else{
        $data['text'] = 'No video source found: ' . $text;
      }
    }

    return Request:: sendMessage($data);
  }
}
