<?php

namespace r3pt1s\game\event;

use pocketmine\event\Cancellable;
use pocketmine\event\CancellableTrait;
use pocketmine\player\Player;
use r3pt1s\game\team\Team;

class PlayerTeamJoinEvent extends TeamEvent implements Cancellable {
    use CancellableTrait;

    public function __construct(
        Team $team,
        private readonly Player $player
    ) {
        parent::__construct($team);
    }

    public function getPlayer(): Player {
        return $this->player;
    }
}