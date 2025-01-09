<?php

namespace r3pt1s\game\event;

use r3pt1s\game\Game;
use r3pt1s\game\state\GameState;

class GameStateChangeEvent extends GameEvent {

    public function __construct(
        Game $game,
        private readonly GameState $oldGameState,
        private readonly GameState $newGameState
    ) {
        parent::__construct($game);
    }

    public function getOldGameState(): GameState {
        return $this->oldGameState;
    }

    public function getNewGameState(): GameState {
        return $this->newGameState;
    }
}