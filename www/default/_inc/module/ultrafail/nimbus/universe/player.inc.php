<?php

namespace ultrafail\nimbus\universe;

class player extends core {

    protected $name;                    // String

    protected $faction_id;              // Integer
    protected $score;                   // Integer
    protected $active_object_id;        // Integer

    // Inherited properties
    protected $readable = array(
        'name','faction_id','score','active_object_id'
    );

    // Initialize
    public function __construct ($id,$data,$init=false) {
        parent::__construct($id,$data,$init);
    }

    public function __destruct () {
        parent::__destruct();
    }

}