<?php

namespace r3pt1s\game\team;

use pocketmine\player\Player;

final class TeamManager {

    /** @var array<Team> */
    private array $teams = [];

    public function registerTeam(Team $team): void {
        $this->teams[] = $team;
    }

    public function unregisterTeam(Team $team): void {
        if (in_array($team, $this->teams)) unset($this->teams[array_search($team, $this->teams)]);
    }

    public function getTeam(Player|string $o): ?Team {
        if ($o instanceof Player) {
            return current(array_filter($this->teams, fn(Team $team) => $team->isInTeam($o))) ?: null;
        }

        return current(array_filter($this->teams, fn(Team $team) => $team->getName() == $o)) ?: null;
    }

    public function getTeams(): array {
        return $this->teams;
    }
}