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

    public function onCommand(CommandSender $sender, Command $cmd, $label, array $args)
    {

      if(strtolower($cmd->getName()) == "chatrooms")
      {

        if(!(isset($args[0])))
        {

          $sender->sendMessage(TF::RED . "Error: not enough args. Usage: /chatrooms <join | list | leave | create | chat> [room | room | name | room] [message].");

          return true;

        }
        else
        {

          if($args[0] === "create")
          {

            unset($args[0]);

            $roomName = implode(" ", $args);

            $player_name = $sender->getName();

            if(isset($this->chats[$roomName]))
            {

              $sender->sendMessage(TF::RED . "Error: " . $roomName . " already exists.");

              return true;

            }
            else
            {

              $this->chats[$roomName] = $player_name;

              $sender->sendMessage(TF::GREEN . "Success: " . $roomName . " was created.");

              $this->server()->broadcastMessage(TF::YELLOW . "Chat room " . $roomName . " created by " . $player_name . " was created.");

              return true;

            }

          }
          else if($args[0] === "join")
          {

            $roomName = implode(" ", $args);

            if(!(isset($this->chats[$roomName])))
            {

              $sender->sendMessage(TF::RED . "Error: " . $roomName . " doesn't exist.");

              return true;

            }
            else
            {

              $player_name = $sender->getName();

              $this->chats[$roomName] .= ", " . $player_name;

            }

          }
          else if($args[0] === "list")
          {

          }
          else if($args[0] === "leave")
          {

          }

        }

      }

    }

  }

?>
