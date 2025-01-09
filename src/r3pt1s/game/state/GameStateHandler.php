<?php

namespace r3pt1s\game\state;

use Closure;

class GameStateHandler {

    private array $handlers = [];

    public function addHandler(GameState $gameState, Closure $handler): void {
        $this->handlers[spl_object_hash($gameState)] = $handler;
    }

    public function removeHandler(GameState $gameState): void {
        if (isset($this->handlers[spl_object_hash($gameState)])) unset($this->handlers[spl_object_hash($gameState)]);
    }

    public function callHandler(GameState $gameState, ...$args): void {
        if (($handler = $this->getHandler($gameState)) !== null) {
            ($handler)(...$args);
        }
    }

    public function getHandler(GameState $gameState): ?Closure {
        return $this->handlers[spl_object_hash($gameState)] ?? null;
    }
}