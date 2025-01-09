<?php

namespace libGame\example;

use GlobalLogger;
use pocketmine\promise\Promise;
use pocketmine\promise\PromiseResolver;
use pocketmine\utils\Config;
use r3pt1s\game\arena\Arena;
use r3pt1s\game\arena\IArenaProvider;

final class JSONArenaProvider implements IArenaProvider {

    # For this to work correctly you might need to use a custom Arena instance too

    private Config $config;

    public function __construct() {
        $this->config = new Config("/your/path/arenas.json", Config::JSON);
    }

    public function load(): Promise {
        $resolver = new PromiseResolver();
        $arenas = [];

        foreach ($this->all() as $value) {
            if (($value = MyArena::fromArray($value)) !== null) $arenas[$value->getName()] = $value;
        }

        $resolver->resolve($arenas);
        return $resolver->getPromise();
    }

    public function add(array $arenaData): void {
        $this->config->set($arenaData["name"], $arenaData);
        try {
            $this->config->save();
        } catch (\JsonException $e) {
            GlobalLogger::get()->logException($e);
        }
    }

    public function remove(string $name): void {
        $this->config->remove($name);
        try {
            $this->config->save();
        } catch (\JsonException $e) {
            GlobalLogger::get()->logException($e);
        }
    }

    public function exists(string $name): bool {
        return $this->config->exists($name);
    }

    public function get(string $name): ?Arena {
        return MyArena::fromArray($this->config->get($name, []));
    }

    public function all(): array {
        return $this->config->getAll();
    }
}