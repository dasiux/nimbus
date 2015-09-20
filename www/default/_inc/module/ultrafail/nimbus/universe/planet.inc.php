<?php

namespace ultrafail\nimbus\universe;

class planet extends celestial {

    protected $name;                    // String

    protected $fields_min = 100;
    protected $fields_max = 2500;

    // Inherited properties
    protected $readable = array(
        'universe_id','faction_id','score','active_object_id'
    );

    // Initialize
    public function __construct ($id,$data,$init=false) {
        parent::__construct($id,$data,$init);
    }
}