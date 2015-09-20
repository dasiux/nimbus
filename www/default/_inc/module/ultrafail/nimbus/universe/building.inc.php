<?php

namespace ultrafail\nimbus\universe;

abstract class building extends core {

    protected $building_type;               // String
    protected $level;                       // Integer
    protected $upgrading_since;             // Integer Unixtime

    protected $upgrade_base_cost;           // resourceArray
    protected $upgrade_level_ratio;         // resourceArray

    protected $resource_capacities;         // Array (String=>Float[,String=>Float[,...]])
    protected $resource_capacity_ratio;     // Float

    protected $resource_production;         // Array (String=>Float[,String=>Float[,...]])
    protected $resource_production_ratio;   // Float

    // Inherited properties
    protected $readable = array(
        'type','level'
    );

    // Initialize
    public function __construct (array $readable,$building_type,$level) {
        if (count($readable)) {$this->readable = array_merge($this->readable,$readable);}
        $this->building_type = $building_type;
        $this->level = $level;
    }

    public function __destruct () {
        parent::__destruct();
    }

    protected function isUpgrading () {
        return ($this->upgrading_since>0?false:true);
    }

    protected function getUpgradeCost () {
        // Return resourceArray
    }

    protected function getUpgradeTimeLeft () {
        // Return Integer Unixtime
        return 0;
    }

}