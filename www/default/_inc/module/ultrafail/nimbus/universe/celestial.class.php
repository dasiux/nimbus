<?php

namespace ultrafail\nimbus\universe;

abstract class celestial extends core {

    protected $location;                // location object

    protected $diameter;                // Integer

    protected $fields;                  // Integer
    protected $fields_min;              // Integer
    protected $fields_max;              // Integer
    protected $fields_available;        // Integer

    protected $buildings;               // Array (building object[,building object[,...]])
    protected $resources;               // Array (resource object[,resource object[,...]])

    protected $last_update_timestamp;   // Integer Unixtime

    // Inherited properties
    protected $readable = array(
        'fields','fields_available'
    );

    // Initialize
    public function __construct ($id,$parent,$data,array $readable=array(),$last_update_timestamp=0,$fields=0,array $buildings=array(),array $resources=array()) {
        parent::__construct($id,$parent,$data);
        if (count($readable)) {$this->readable = array_merge($this->readable,$readable);}
        $this->last_update_timestamp = $last_update_timestamp;
        if ($fields==0){$this->fields = $this->newFields();}
        $this->buildings =  $buildings;
        $this->resources =  $resources;
    }

    public function __destruct () {
        parent::__destruct();
    }

    protected function newFields () {
        $this->diameter;
        return rand($this->fields_min,$this->fields_max);
    }

    protected function getFieldsAvailable () {
        if (!isset($this->fields_available)) {
            $this->fields_available = $this->fields-$this->getFieldsInUse();
        }
        return $this->fields_available;
    }

    protected function getFieldsInUse () {
        $used = 0;
        if (count($this->buildings)) {
            foreach ($this->buildings as $building) {
                $used += $building->level;
            }
        }
        return $used;
    }

    public function getDistanceFromSun () {
        // Return Float
        return 1.0;
    }

    public function getResourceProductionRatio (resource $resource) {
        // Buildings
        // ^Penalties
        // Return Float
        return 1.0;
    }

    public function getStorageMax (resource $resource) {
        // Return Integer
        return 1;
    }
}