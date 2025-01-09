<?php

namespace r3pt1s\game\arena;

interface IArenaProvider {

    public function load(): void;

    public function add(array $mapData): void;

    public function remove(string $name): void;

    public function exists(string $name): void;

    public function get(string $name): ?Arena;

    public function all(): array;
}