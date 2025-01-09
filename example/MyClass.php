<?php

namespace libGame\example;

use pocketmine\plugin\PluginBase;
use r3pt1s\game\arena\Arena;
use r3pt1s\game\Game;
use r3pt1s\game\libGame;

final class MyClass extends PluginBase {

    protected function onEnable(): void {
        libGame::init($this)
            ->setGameCreationHandler(function (string $name, array $players, Arena $arena): Game { # You can use any parameters here as long as you provide them when creating a game
                # If you have to, copy worlds or do stuff you need to do before creating the Game instance
                return new Game($name, $players, $arena);
            })
            ->setArenaProvider(new JSONArenaProvider()); # Your ArenaProvider for saving and loading arenas
    }
}