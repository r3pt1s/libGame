<?php

namespace r3pt1s\game\arena;

use pocketmine\promise\Promise;

interface IArenaProvider {

    public function load(): Promise;

    public function add(array $arenaData): void;

    public function remove(string $name): void;

    public function exists(string $name): bool;

    public function get(string $name): ?Arena;

    public function all(): array;
}