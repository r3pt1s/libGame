<?php

namespace r3pt1s\game;

use Closure;
use GlobalLogger;
use LogicException;
use pocketmine\player\Player;
use pocketmine\plugin\Plugin;
use r3pt1s\game\arena\Arena;
use r3pt1s\game\arena\ArenaManager;
use r3pt1s\game\arena\IArenaProvider;
use r3pt1s\game\state\GameStateHandler;
use r3pt1s\game\team\TeamManager;
use Throwable;

final class libGame {

    private static ?self $instance = null;
    private static ?Plugin $pluginInstance = null;
    private ?Closure $gameCreationHandler;
    private ?GameStateHandler $gameStateHandler;
    private ?TeamManager $teamManager;
    private ?ArenaManager $arenaManager;
    private ?IArenaProvider $arenaProvider = null;
    private array $games = [];

    public static function init(Plugin $plugin): libGame {
        if (self::$pluginInstance !== null) {
            throw new LogicException("{$plugin->getName()} tried to initialize the libGame library twice.");
        }

        self::$pluginInstance = $plugin;
        return new self();
    }

    public function __construct() {
        $this->gameStateHandler = new GameStateHandler();
        $this->teamManager = new TeamManager();
        $this->arenaManager = new ArenaManager();
        $this->gameCreationHandler = fn(array $players, Arena $arena) => new Game($players, $arena);
    }

    public function createGame(string $name, ...$args): Game|false {
        try {
            return $this->games[$name] = ($this->gameCreationHandler)(...$args);
        } catch (Throwable $exception) {
            GlobalLogger::get()->logException($exception);
        }
        return false;
    }

    public function setGameCreationHandler(?Closure $gameCreationHandler): self {
        $this->gameCreationHandler = $gameCreationHandler;
        return $this;
    }

    public function setArenaProvider(?IArenaProvider $arenaProvider): self {
        $this->arenaProvider = $arenaProvider;
        return $this;
    }

    public function getGameStateHandler(): GameStateHandler {
        return $this->gameStateHandler ??= new GameStateHandler();
    }

    public function getTeamManager(): TeamManager {
        return $this->teamManager ??= new TeamManager(); 
    }

    public function getArenaManager(): ?ArenaManager {
        return $this->arenaManager;
    }

    public function getArenaProvider(): ?IArenaProvider {
        return $this->arenaProvider;
    }

    public function getGame(Player|string $v): ?Game {
        if ($v instanceof Player) {
            return current(array_filter($this->games, fn(Game $game) => $game->isPlayer($v))) ?: null;
        }

        return $this->games[$v] ?? null;
    }

    public function getGames(): array {
        return $this->games;
    }

    public static function getPlugin(): ?Plugin {
        return self::$pluginInstance;
    }

    public static function get(): ?libGame {
        return self::$instance;
    }
}