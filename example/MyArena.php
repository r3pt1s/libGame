<?php

namespace libGame\example;

use pocketmine\Server;
use pocketmine\world\World;
use r3pt1s\game\arena\Arena;

final class MyArena extends Arena {

    public function __construct(
        string $name,
        private readonly World $world
    ) {
        parent::__construct($name);
    }

    public function toArray(): array {
        return [
            "name" => $this->name,
            "world" => $this->world->getFolderName()
        ];
    }

    public static function fromArray(array $data): ?MyArena {
        if (isset($data["world"], $data["name"])) {
            if (($world = Server::getInstance()->getWorldManager()->getworld($data["world"])) instanceof World) {
                return new self($data["name"], $world);
            }
        }
        return null;
    }
}