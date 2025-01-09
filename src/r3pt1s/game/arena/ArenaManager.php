<?php

namespace r3pt1s\game\arena;

use InvalidArgumentException;
use r3pt1s\game\libGame;

final class ArenaManager {

    /** @var array<Arena> */
    private array $arenas = [];

    public function add(Arena $arena): void {
        if (!isset($this->arenas[$arena->getName()])) {
            $this->arenas[$arena->getName()] = $arena;
            libGame::get()->getArenaProvider()?->add($arena->toArray());
        } else throw new InvalidArgumentException("Arena {$arena->getName()} already exists.");
    }

    public function remove(Arena $arena): void {
        if (isset($this->arenas[$arena->getName()])) {
            unset($this->arenas[$arena->getName()]);
            libGame::get()->getArenaProvider()?->remove($arena->getName());
        } else throw new InvalidArgumentException("Arena {$arena->getName()} does not exist.");
    }

    public function random(): ?Arena {
        if (empty($this->arenas)) return null;
        return $this->arenas[array_rand($this->arenas)];
    }

    public function getArena(string $arena): ?Arena {
        return $this->arenas[$arena] ?? null;
    }

    public function getArenas(): array {
        return $this->arenas;
    }
}