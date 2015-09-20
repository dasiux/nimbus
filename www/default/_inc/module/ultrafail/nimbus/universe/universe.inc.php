<?php

namespace ultrafail\nimbus\universe;

class universe extends core {

    protected $name;                    // String

    // Inherited properties
    protected $readable = array(
        'name'
    );

    // Initialize
    public function __construct ($id,$parent,$data,$init=false) {
        parent::__construct($id,$parent,$data,$init);
    }

    public function __destruct () {
        parent::__destruct();
    }

}