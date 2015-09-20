<?php

namespace ultrafail\nimbus\universe;

use \sqf\db;
use \ultrafail\nimbus\game;

abstract class core {

    // Object properties
    protected $readable = array();      // Array (String[,String[,...]])
    protected $writable = array();      // Array (String[,String[,...]])

    protected $id;                      // Integer
    protected $type;                    // String
    protected $parent_id;               // Integer
    protected $location_id;             // Integer
    protected $children = array();      // Array (core object[,core object[,...]])

    protected $prevent_load_children = false;

    protected $sql_type_select = false;

    // Initialize
    public function __construct ($id,$data,$init=false) {
        array_push($this->readable,'id','type','parent_id','location_id','children');
        $this->writable = array_merge($this->writable,array(
            'prevent_load_children'=>'is_bool'
        ));
        $this->id = $id;
        $this->parseData($data);
        $this->loadFromDB();

        if ($init&&in_array($this->getType(),game::$init_end_class)) {
            if (!in_array($id,game::$init_end_except_id)) {
                $this->prevent_load_children = true;
            }
        }

        if (!$this->prevent_load_children) {
            $this->children = game::loadChildren($this->id);
        }
    }

    public function __destruct () {
        // Update db
        $this->saveToDB();
    }

    protected function parseData ($data) {
        foreach ($data as $key => $value) {
            $parser = 'parse'.game::_2camel($key);
            if (method_exists($this,$parser)) {
                $this->$key = $parser($value);
            } elseif (!isset($this->$key)) {
                $this->$key = $value;
            }
        }
    }

    protected function loadFromDB () {
        $query = db::entry("SELECT ".($this->sql_type_select?$this->sql_type_select:"*")
            ." FROM ".$this->getType()
            ." WHERE id=".$this->id);
        if ($query) {
            $this->parseData($query);
        } else {
            throw new exception('Corrupted object #'.$this->id);
        }
    }
    protected function saveToDB () {
        $magic = '';
    }

    protected function getType () {
        if (!isset($this->type)) {
            $class = explode('\\',strtolower(get_called_class()));
            $this->type = implode('_',$class);
        }
        return $this->type;
    }

    // Universal get readable internal property
    public function __get ($name) {
        if (in_array($name,$this->readable)) {
            $handler = 'get'.game::_2camel($name);
            if (method_exists($this,$handler)) {
                return $this->$handler();
            }
            return $this->$name;
        } else {
            throw new exception(get_called_class().': Unreadable Property ('.$name.')');
        }
    }
    // Universal set writable internal property
    public function __set ($name,$value) {
        if (in_array($this->$name,$this->writable)) {
            $handler = 'set'.game::_2camel($name);
            if (method_exists($this,$handler)) {
                $this->$handler();
                return;
            }
            $this->$name = $value;
        } else {
            throw new exception('Unwritable Property ('.$name.')');
        }
    }

    // Events
    public function callEvent ($name,event $event) {
        $eventHandler = 'event'.game::_2camel($name);
        if (method_exists($this,$eventHandler)) {
            $this->$eventHandler($event);
        }
        if (!$event->preventBubbleUp) {
            $this->parent->callEvent($name,$event);
        }
        if (!$event->preventBubbleDown&&count($this->children)) {
            $limit = count($event->bubbleDownTypes);
            foreach ($this->children as $child) {
                if (!$limit||($limit&&in_array($child->type,$limit))) {
                    $child->callEvent($name,$event);
                }
            }

        }
    }

}