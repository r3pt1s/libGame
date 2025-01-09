<?php

namespace r3pt1s\game;

use pocketmine\player\Player;
use pocketmine\Server;
use r3pt1s\game\arena\Arena;
use r3pt1s\game\event\GameStateChangeEvent;
use r3pt1s\game\state\GameState;
use r3pt1s\game\tick\GameTick;

class Game {

    protected GameListener $listener;
    protected GameState $gameState;
    protected GameTick $gameTick;
    protected GameStorage $gameStorage;

    /**
     * @param array<Player> $players
     */
    public function __construct(
        protected array $players,
        protected Arena $arena,
        ?GameListener $gameListener = null
    ) {
        $this->listener = $gameListener ?? new GameListener();
        $this->gameState = GameState::WAITING();
        $this->gameTick = new GameTick(Server::getInstance()->getTick());
        $this->gameStorage = new GameStorage();
    }

    public function broadcastMessage(string $message): void {
        foreach ($this->players as $player) $player->sendMessage($message);
    }

    public function broadcastTitle(string $title): void {
        foreach ($this->players as $player) $player->sendTitle($title);
    }

    public function broadcastTip(string $tip): void {
        foreach ($this->players as $player) $player->sendTip($tip);
    }

    public function broadcastPopup(string $popup): void {
        foreach ($this->players as $player) $player->sendPopup($popup);
    }

    public function broadcastActionBarMessage(string $message): void {
        foreach ($this->players as $player) $player->sendActionBarMessage($message);
    }

    public function addPlayer(Player $player): void {
        $this->players[spl_object_id($player)] = $player;
    }

    public function removePlayer(Player $player): void {
        if (isset($this->players[($id = spl_object_id($player))])) unset($this->players[$id]);
    }

    public function nextState(): void {
        $this->setGameState(
            $this->gameState === GameState::WAITING() ? GameState::STARTING() : ($this->gameState === GameState::STARTING() ? GameState::IN_GAME() : GameState::ENDING())
        );
    }

    public function setGameState(GameState $gameState): void {
        (new GameStateChangeEvent($this, $this->gameState, $gameState))->call();
        $this->gameState = $gameState;
        libGame::get()->getGameStateHandler()->callHandler($gameState);
    }

    public function getListener(): GameListener {
        return $this->listener;
    }

    public function getGameState(): GameState {
        return $this->gameState;
    }

    public function getGameTick(): GameTick {
        return $this->gameTick;
    }

    public function getGameStorage(): GameStorage {
        return $this->gameStorage;
    }

    public function getPlayerCount(): int {
        return count($this->players);
    }

    public function isPlayer(Player $player): bool {
        return isset($this->players[spl_object_id($player)]);
    }

    public function getPlayers(): array {
        return $this->players;
    }

    public function getArena(): Arena {
        return $this->arena;
    }
}