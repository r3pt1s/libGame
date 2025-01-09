<?php

namespace r3pt1s\game\arena;

abstract class Arena {

    public function __construct(protected string $name) {}

    public function getName(): string {
        return $this->name;
    }

    abstract public function toArray(): array;

    abstract public static function fromArray(array $data): ?static;
}