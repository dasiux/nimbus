<?php

namespace ultrafail\nimbus\universe;

abstract class resource extends core {

    protected $name;                    // String

    protected $deposit;                 // Float  Amount of resource available on celestial

    protected $stored;                  // Float  Amount of resource available for production
    protected $max;                     // Integer  Storage maximum capacity

    // Required related objects
    protected $celestial;               // celestial object

    // Inherited properties
    protected $readable = array(
        'name','max'
    );

    // Initialize
    public function __construct ($name,celestial $celestial,$stored,$deposit) {
        $this->name = $name;
        $this->celestial = $celestial;
        $this->stored = $stored;
        $this->deposit = $deposit;
        $this->max = $this->celestial->getStorageMax($this);
    }

    public function __destruct () {
        parent::__destruct();
    }

    public function getStored ($float=false) {
        if (!isset($this->stored)) {
            $seconds_produced = self::$now-$this->celestial->last_update_timestamp;
            $theoretical_production = $seconds_produced*$this->getProductionPerSecond();
            $this->stored += floatval(($theoretical_production<$this->max?$theoretical_production:$this->max));
        }
        return ($float?$this->stored:floor($this->stored));
    }

    protected function getProductionPerSecond () {
        $this->celestial->getDistanceFromSun();
        $this->celestial->getResourceProductionRatio($this);
        // Return Float
        return 1.0;
    }

}