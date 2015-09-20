<?php

namespace ultrafail\nimbus\universe;

class planet extends celestial {

    protected $fields_min = 100;
    protected $fields_max = 2500;

    // Initialize
    public function __construct ($last_update_timestamp,$fields) {
        parent::__construct(array(),$last_update_timestamp,$fields);
    }
}