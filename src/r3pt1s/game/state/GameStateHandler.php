<?php

namespace r3pt1s\game\state;

use Closure;

class GameStateHandler {

    private array $handlers = [];

    public function addHandler(GameState $gameState, Closure $handler): void {
        $this->handlers[spl_object_id($gameState)] = $handler;
    }

    public function removeHandler(GameState $gameState): void {
        if (isset($this->handlers[spl_object_id($gameState)])) unset($this->handlers[spl_object_id($gameState)]);
    }

    public function removeAllHandler(): void {
        $this->handlers = [];
    }

    public function callHandler(GameState $gameState, ...$args): void {
        if (($handler = $this->getHandler($gameState)) !== null) {
            ($handler)(...$args);
        }
    }

    public function getHandler(GameState $gameState): ?Closure {
        return $this->handlers[spl_object_id($gameState)] ?? null;
    }
}