<?php

namespace r3pt1s\game\event;

use pocketmine\event\Event;
use r3pt1s\game\team\Team;

abstract class TeamEvent extends Event {

    public function __construct(private readonly Team $team) {}

    public function getTeam(): Team {
        return $this->team;
    }
}