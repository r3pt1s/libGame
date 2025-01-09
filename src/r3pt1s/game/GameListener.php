<?php

namespace r3pt1s\game;

use GlobalLogger;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityItemPickupEvent;
use pocketmine\event\entity\EntityTrampleFarmlandEvent;
use pocketmine\event\entity\ItemMergeEvent;
use pocketmine\event\Event;
use pocketmine\event\EventPriority;
use pocketmine\event\inventory\CraftItemEvent;
use pocketmine\event\inventory\InventoryTransactionEvent;
use pocketmine\event\player\PlayerBedEnterEvent;
use pocketmine\event\player\PlayerBedLeaveEvent;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerDisplayNameChangeEvent;
use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\event\player\PlayerExhaustEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerItemConsumeEvent;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerJumpEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\player\PlayerRespawnEvent;
use pocketmine\event\player\PlayerToggleSneakEvent;
use pocketmine\event\RegisteredListener;
use pocketmine\event\world\ChunkLoadEvent;
use pocketmine\event\world\WorldLoadEvent;
use pocketmine\event\world\WorldUnloadEvent;
use pocketmine\Server;
use r3pt1s\game\event\GameStateChangeEvent;
use ReflectionException;

class GameListener {

    public function __construct() {
        try {
            $this->listen(PlayerJoinEvent::class, [$this, "onJoin"]);
            $this->listen(PlayerQuitEvent::class, [$this, "onQuit"]);
            $this->listen(PlayerJumpEvent::class, [$this, "onJump"]);
            $this->listen(PlayerMoveEvent::class, [$this, "onMove"]);
            $this->listen(PlayerToggleSneakEvent::class, [$this, "onSneak"]);
            $this->listen(PlayerInteractEvent::class, [$this, "onInteract"]);
            $this->listen(PlayerChatEvent::class, [$this, "onChat"]);
            $this->listen(PlayerItemUseEvent::class, [$this, "onItemUse"]);
            $this->listen(BlockPlaceEvent::class, [$this, "onPlace"]);
            $this->listen(BlockBreakEvent::class, [$this, "onBreak"]);
            $this->listen(PlayerExhaustEvent::class, [$this, "onExhaust"]);
            $this->listen(PlayerItemConsumeEvent::class, [$this, "onConsume"]);
            $this->listen(PlayerDisplayNameChangeEvent::class, [$this, "onDisplayNameChange"]);
            $this->listen(PlayerBedEnterEvent::class, [$this, "onBedEnter"]);
            $this->listen(PlayerBedLeaveEvent::class, [$this, "onBedLeave"]);
            $this->listen(InventoryTransactionEvent::class, [$this, "onTransaction"]);
            $this->listen(GameStateChangeEvent::class, [$this, "onGameStateChange"]);
            $this->listen(EntityDamageEvent::class, [$this, "onDamage"]);
            $this->listen(EntityDamageByEntityEvent::class, [$this, "onEntityDamage"]);
            $this->listen(PlayerDeathEvent::class, [$this, "onDeath"]);
            $this->listen(PlayerRespawnEvent::class, [$this, "onRespawn"]);
            $this->listen(CraftItemEvent::class, [$this, "onCraft"]);
            $this->listen(PlayerDropItemEvent::class, [$this, "onDrop"]);
            $this->listen(EntityItemPickupEvent::class, [$this, "onPickUp"]);
            $this->listen(ChunkLoadEvent::class, [$this, "onChunkLoad"]);
            $this->listen(EntityTrampleFarmlandEvent::class, [$this, "onTrample"]);
            $this->listen(ItemMergeEvent::class, [$this, "onItemMerge"]);
            $this->listen(WorldLoadEvent::class, [$this, "onWorldLoad"]);
            $this->listen(WorldUnloadEvent::class, [$this, "onWorldUnload"]);
        } catch (ReflectionException $exception) {
            GlobalLogger::get()->logException($exception);
        }
    }

    /**
     * @throws ReflectionException
     */
    public function listen(string $event, callable $handler, int $priority = EventPriority::HIGHEST): RegisteredListener {
        return Server::getInstance()->getPluginManager()->registerEvent($event, $handler, $priority, libGame::getPlugin());
    }

    public function onJoin(PlayerJoinEvent $event): void {}

    public function onQuit(PlayerQuitEvent $event): void {}

    public function onJump(PlayerJumpEvent $event): void {}

    public function onMove(PlayerMoveEvent $event): void {}

    public function onSneak(PlayerToggleSneakEvent $event): void {}

    public function onInteract(PlayerInteractEvent $event): void {}

    public function onChat(PlayerChatEvent $event): void {}

    public function onItemUse(PlayerItemUseEvent $event): void {}

    public function onPlace(BlockPlaceEvent $event): void {}

    public function onBreak(BlockBreakEvent $event): void {}

    public function onExhaust(PlayerExhaustEvent $event): void {}

    public function onConsume(PlayerItemConsumeEvent $event): void {}

    public function onDisplayNameChange(PlayerDisplayNameChangeEvent $event): void {}

    public function onBedEnter(PlayerBedEnterEvent $event): void {}

    public function onBedLeave(PlayerBedLeaveEvent $event): void {}

    public function onTransaction(InventoryTransactionEvent $event): void {}

    public function onGameStateChange(GameStateChangeEvent $event): void {}

    public function onDamage(EntityDamageEvent $event): void {}

    public function onEntityDamage(EntityDamageByEntityEvent $event): void {}

    public function onDeath(PlayerDeathEvent $event): void {}

    public function onRespawn(PlayerRespawnEvent $event): void {}

    public function onCraft(CraftItemEvent $event): void {}

    public function onDrop(PlayerDropItemEvent $event): void {}

    public function onPickUp(EntityItemPickupEvent $event): void {}

    public function onChunkLoad(ChunkLoadEvent $event): void {}

    public function onTrample(EntityTrampleFarmlandEvent $event): void {}

    public function onItemMerge(ItemMergeEvent $event): void {}

    public function onWorldLoad(WorldLoadEvent $event): void {}

    public function onWorldUnload(WorldUnloadEvent $event): void {}
}