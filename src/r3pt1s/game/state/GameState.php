<?php

namespace r3pt1s\game\state;

use pocketmine\utils\RegistryTrait;

/**
 * @method static GameState WAITING()
 * @method static GameState STARTING()
 * @method static GameState IN_GAME()
 * @method static GameState ENDING()
 */

final class GameState {
    use RegistryTrait;

    protected static function setup(): void {
        self::_registryRegister("waiting", new GameState());
        self::_registryRegister("starting", new GameState());
        self::_registryRegister("in_game", new GameState());
        self::_registryRegister("ending", new GameState());
    }

    public function isWaiting(bool $literal = false): bool {
        return $this === GameState::WAITING() || (!$literal && $this === GameState::STARTING());
    }

    public function isStarting(): bool {
        return $this === GameState::STARTING();
    }

    public function isInGame(): bool {
        return $this === GameState::IN_GAME();
    }

    public function isEnding(): bool {
        return $this === GameState::ENDING();
    }
}