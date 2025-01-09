<?php

namespace libGame\example;

use pocketmine\event\EventPriority;
use r3pt1s\game\GameListener;

final class MyGameListener extends GameListener {

    public function __construct() {
        parent::__construct();
        # Listen to more events if needed
        $this->listen(YourEvent::class, function (YourEvent $event): void {
            # Your code
        }, EventPriority::HIGHEST);
    }
}