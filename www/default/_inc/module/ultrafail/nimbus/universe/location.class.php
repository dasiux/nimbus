<?php

namespace ultrafail\nimbus\universe;

class location extends core {

    protected $x;       // Float
    protected $y;       // Float
    protected $z;       // Float

    // Inherited properties
    protected $readable = array(
        'x','y','z'
    );

    // Initialize
    public function __construct ($x,$y,$z) {
        $this->x = floatval($x);
        $this->y = floatval($y);
        $this->z = floatval($z);
    }

    public function getDistanceFrom (location $location) {
        // Return Float
        return 1.0;
    }
}