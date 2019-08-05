<?php
namespace SpawnFlyHC;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat as TE;
use pocketmine\event\entity\EntityLevelChangeEvent;
use pocketmine\event\player\PlayerJoinEvent;

class SpawnFlyHC extends PluginBase implements Listener
{
    public function onEnable()
    {
        $this->getLogger()->info(TE::YELLOW . "Loading Spawn Fly");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    public function onLevelChange(EntityLevelChangeEvent $event)
    {
        $player = $event->getEntity();
        $target = $event->getTarget()->getFolderName();
        $spawn = $this->getServer()->getDefaultLevel()->getFolderName();
        if ($target==$spawn) {
            $player->setAllowFlight(true);
            $this->getLogger()->info($player->getName()."님의 fly가 허용되었습니다.");
        } else {
            if ($player->getGamemode()==0 or $player->getGamemode()==2) {
                $player->setAllowFlight(false);
                $player->setFlying(false);
                $this->getLogger()->info($player->getName()."님의 fly가 비허용되었습니다.");
            }
        }
    }
    public function onJoin(PlayerJoinEvent $event)
    {
        $player=$event->getPlayer();
        $spawn = $this->getServer()->getDefaultLevel()->getFolderName();
        if ($player->getLevel()->getFolderName()==$spawn) {
            $player->setAllowFlight(true);
            $this->getLogger()->info($player->getName()."님의 fly가 허용되었습니다.");
        }
    }
}
