<?php

namespace ultrafail\nimbus;

use \sqf\db;
use \sqf\template;

class game {

    static public $now;                             // Integer Unixtime

    static public $sql_object_table = 'ultrafail_nimbus_objects';

    static public $instances = array();

    static public $init_done = false;               // Boolean
    static public $init_end_class = array(          // Last type to load
        'ultrfail_nimbus_universe_planet'
    );
    static public $init_end_except_id = array(      // Finish object tree for these ids

    );

    // Settable properties
    static public $universe_id;                     // Integer

    // Internal properties
    static protected $selected_planet_id = 0;       // Integer

    // Run game
    static public function run () {
        self::$now = time();
        if (self::$selected_planet_id) {
            self::$init_end_except_id[] = self::$selected_planet_id;
        }
        $universe = self::getObject(self::$universe_id,true);
        $uni_children = $universe->children;

        return (string)new template(array(
            'player_name'   => $uni_children[0]->name,
            'player_score'  => $uni_children[0]->score,
            'player_rank'   => '0',
            'faction_id'    => $uni_children[0]->faction_id,
            'faction_name'  => 'faction'
        ),'ultrafail/nimbus/base');

        return '<pre>'.print_r(self::$instances,true).'</pre>';
    }

    // Global static functions
    static public function getClassFromType ($type) {
        $x = explode('_',strtolower($type));
        return implode('\\',$x);
    }
    static public function getObject ($id,$init=false) {
        $id = (int)$id;
        if (!$id) {return false;}
        if (!isset(self::$instances[$id])) {
            $query = db::entry("SELECT * FROM ".self::$sql_object_table." WHERE id=".$id." LIMIT 1");
            if (!$query) {return;}
            $class = self::getClassFromType($query['type']);
            self::$instances[$id] = new $class($id,$query,$init);
        }

        return self::$instances[$id];
    }
    static public function _2camel ($string) {
        $x = explode('_',strtolower($string));
        return implode($x);
    }
    static public function loadChildren ($parent) {
        $parent = (int)$parent;
        if (!$parent) {return false;}
        $children = array();
        $query = db::rows("SELECT id FROM ".self::$sql_object_table." WHERE parent_id=".$parent);
        if (count($query)) {
            foreach ($query as $object) {
                $children[] = self::getObject($object['id']);
            }
        }
        return $children;
    }

}