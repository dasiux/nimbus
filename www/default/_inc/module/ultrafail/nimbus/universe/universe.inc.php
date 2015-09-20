<?php

namespace ultrafail\nimbus\universe;

use \ultrafail\nimbus\game;

class universe extends core {

    protected $name;                    // String

    // Inherited properties
    protected $readable = array(
        'name'
    );

    protected $filter_children;

    // Initialize
    public function __construct ($id,$parent,$data,$init=false) {
        $this->filter_children = array(
            'ultrafail_nimbus_universe_universe' => array(game::$player_id)
        );
        parent::__construct($id,$parent,$data,$init);
    }

    public function __destruct () {
        parent::__destruct();
    }

}