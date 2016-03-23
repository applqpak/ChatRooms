<?php

  namespace ChatRooms;

  use pocketmine\plugin\PluginBase;
  use pocketmine\utils\TextFormat as TF;
  use pocketmine\command\Command;
  use pocketmine\command\CommandSender;

  class Main extends PluginBase
  {

    private $chats = array();

    public function dataPath()
    {

      return $this->getDataFolder();

    }

    public function server()
    {

      return $this->getServer();

    }

    public function onEnable()
    {

      if(!(is_dir($this->dataPath())))
      {

        @mkdir($this->dataPath());

        @touch($this->dataPath() . "chats.txt");

        @chdir($this->dataPath());

      }

    }

    public function onCommand(CommandSender $sender, Command $cmd, $label, array $args)
    {

      if(strtolower($cmd->getName()) == "chatrooms")
      {

        if(!(isset($args[0])))
        {

          $sender->sendMessage(TF::RED . "Error: not enough args. Usage: /chatrooms <join | list | leave | chat> [room | room | message]");

          return true;

        }
        else
        {

        }

      }

    }

  }

?>
