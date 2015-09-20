<?php

namespace ultrafail\nimbus\universe;

class player extends core {

    protected $name;                    // String

    // Inherited properties
    protected $readable = array(
        'name'
    );

    // Initialize
    public function __construct ($id,$parent,$data) {
        parent::__construct($id,$parent,$data);
    }

    public function __destruct () {
        parent::__destruct();
    }

}