<?php

namespace ultrafail\nimbus;

class game {

    // Settable properties
    static public $player_id;              // Integer

    // Internal properties
    static protected $selected_planet_id;  // Integer

    // Run game
    static public function run () {
        $player = universe\core::getObject(self::$player_id);
    }

}