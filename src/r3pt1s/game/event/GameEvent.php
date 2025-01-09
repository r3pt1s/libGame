<?php

namespace r3pt1s\game\event;

use pocketmine\event\Event;
use r3pt1s\game\Game;

abstract class GameEvent extends Event {

    public function __construct(private readonly Game $game) {}

    public function getGame(): Game {
        return $this->game;
    }
}