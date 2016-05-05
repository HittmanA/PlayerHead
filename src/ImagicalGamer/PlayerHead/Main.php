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

class Main extends PluginBase implements Listener{
  public function onEnable(){
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
    $this->getLogger()->info(C::GREEN . "Enabled!");
  }
  public function onDeath(PlayerDeathEvent $event){
    $item = Item::get(397, 3, 1);
    $e = $event->getEntity();
    $level = $e->getLevel();
    $x = $e->getX();
    $y = $e->getY();
    $z = $e->getZ();
    if($e instanceof Player){
	$level->setBlock(new Vector3($x,$y,$z), Block::get(144));
      $name = $e->getName();
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
