<?php

namespace r3pt1s\game\tick;

use pocketmine\Server;

readonly class GameTick {
    
    public function __construct(private int $startTick) {}

    public function getHours(): int {
        return floor($this->getMinutes() / 60);
    }

    public function getMinutes(): int {
        return floor($this->getSeconds() / 60);
    }

    public function getSeconds(): int {
        return floor($this->getTick() / 20);
    }

    public function getTick(): int {
        return Server::getInstance()->getTick() - $this->startTick;
    }

    public function getStartTick(): int {
        return $this->startTick;
    }
}