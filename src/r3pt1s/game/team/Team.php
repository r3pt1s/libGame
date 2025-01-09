<?php

namespace r3pt1s\game\team;

use pocketmine\player\Player;

final class Team {

    /** @var array<Player> */
    private array $players = [];

    public function __construct(
        private readonly string $name,
        private readonly int $maxPlayers,
        private array $extraData = []
    ) {}

    public function addPlayer(Player $player): void {
        $this->players[] = $player;
    }

    public function removePlayer(Player $player): void {
        if (in_array($player, $this->players)) unset($this->players[array_search($player, $this->players)]);
    }

    public function isInTeam(Player $player): bool {
        return in_array($player, $this->players);
    }

    public function setDataEntry(string $name, mixed $value): void {
        $this->extraData[$name] = $value;
    }

    public function getPlayers(): array {
        return $this->players;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getMaxPlayers(): int {
        return $this->maxPlayers;
    }

    public function getDataEntry(string $name): mixed {
        return $this->extraData[$name] ?? null;
    }

    public function getExtraData(): array {
        return $this->extraData;
    }

    public function isFull(): bool {
        return count($this->players) == $this->maxPlayers;
    }
}