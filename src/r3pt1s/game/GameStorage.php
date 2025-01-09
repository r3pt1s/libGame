<?php

namespace r3pt1s\game;

final class GameStorage {

    private array $storage = [];

    public function set(string $key, mixed $value, bool $addToArray = false): void {
        if (isset($this->storage[$key]) && is_array($this->storage[$key]) && $addToArray) {
            $this->storage[$key][] = $value;
        } else {
            $this->storage[$key] = $value;
        }
    }

    public function get(string $key, mixed $default = null): mixed {
        return $this->storage[$key] ?? $default;
    }

    public function all(): array {
        return $this->storage;
    }
}