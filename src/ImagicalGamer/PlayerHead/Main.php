<?php
namespace ImagicalGamer\PlayerHead;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\plugin\Plugin;

use pocketmine\event\player\PlayerDeathEvent;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\item\Item;
use pocketmine\block\Block;

use pocketmine\utils\TextFormat as C;

use pocketmine\math\Vector3;
use pocketmine\level\Level;
use pocketmine\level\Position;
use pocketmine\entity\Entity;
use pocketmine\level\particle\FloatingTextParticle;

use pocketmine\tile\Skull;
use pocketmine\nbt\tag\ByteTag;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\NBT;
use pocketmine\nbt\tag\StringTag as S;
use pocketmine\nbt\tag\IntTag as I;
use pocketmine\nbt\tag\ListTag as Enum;
use pocketmine\tile\Tile;
use pocketmine\level\format\FullChunk;
use pocketmine\utils\config;

class Main extends PluginBase implements Listener{
  public function onEnable(){
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
    $this->getLogger()->info(C::GREEN . "Enabled!");
    $this->saveResource("/config.yml");
    
    @mkdir($this->getDataFolder());
    $config = new Config($this->getDataFolder() . "world.yml", Config::YAML);
    $config->save()
  }
  public function onCommand(){
  		public function onCommand(CommandSender $sender, Command $command, $label, array $args){
     if (((strtolower($command->getName () ) == "head" && isset($args [0] )) {
       			if (!$sender instanceof Player) {
					$sender->sendMessage ("");
					return;
			}
			else if (! $sender->isOp ()) {
			$sender->sendMessage ($this->prefix . "You are not authorized to use this command!" );
			}
			else if($args[0] == true){
				$config->set("active", "true");
			}
			else if($args[0] == false{
			$config->set("active", "false");
			}
			else if($args[0] != false && $args[0] != true){
				$sender->sendMessage ($this->prefix . "use /head [true/false]!" );
			}
				
    }
}
  }
  public function onDeath(PlayerDeathEvent $event){
    $rand = rand(1, 5);
    switch($rand){
    	case '1':
    		$head = 397;
    	break;
        case '2':
        	$head = 397:1;
        break;
        case '3':
        	$head = 397:2;
        break;
        case '4':
        	$head = 397:3;
        break;
        case '5':
        	$head = 397:4;
        break;
    }
    $item = Item::get(397, 3, 1);
    $entity = $event->getEntity();
    $level = $e->getLevel();
    $x = $e->getX();
    $y = $e->getY();
    $z = $e->getZ();
    $sth = $config->getAll();
    $worlds = $sth["Worlds"];
    $active = $sth["active"];
    if($level->getName()!= $worlds && $active!=false){
    if($entity instanceof Player){
	$level->setBlock(new Vector3($x,$y,$z), Block::get($head));
      $name = $entity->getName();
      $text = C::RED . C::BOLD . $name . "'s head!";
      $particle = new FloatingTextParticle(new Vector3($x, $y, $z), $text);
      $level->addParticle($particle);
      $killer = $e->getLastDamageCause();
         if($killer instanceof Player){
           $killer->getInventory()->addItem($item);
           $item->setCustomName($name . "'s head");
         }
    }
    }

  }
}
