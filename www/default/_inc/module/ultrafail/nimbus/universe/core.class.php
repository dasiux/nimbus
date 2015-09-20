<?php

namespace ultrafail\nimbus\universe;

abstract class core {

    // Global static values
    static public $now = 0;                         // !!! move to other class
    static public $sql_object_table = 'objects';
    static public $instances = array();

    // Global static functions
    static public function getClassFromType ($type) {
        $x = explode('_',$type);
        array_walk($x,'strtolower');
        return implode('\\',$x);
    }
    static public function getObject ($id) {
        $id = (int)$id;
        if (!$id) {return false;}
        if (!isset(self::$instances[$id])) {
            $query = "SELECT * FROM ".self::$sql_object_table." WHERE id=".$id;
            $parent = self::getObject('!!! parent');
            $class = self::getClassFromType('!!! type');
            self::$instances[$id] = new $class($id,$parent,$query);
        }
        return self::$instances[$id];
    }
    static public function _2camel ($string) {
        $x = explode('_',$string);
        array_walk($x,'ucfirst');
        return implode($x);
    }

    // Internal static functions
    static protected function loadChildren ($parent) {
        $parent = (int)$parent;
        if (!$parent) {return false;}
        $children = array();
        $query = "SELECT id FROM ".self::$sql_object_table." WHERE parent_id=".$parent;
        if (count($query)) {
            foreach ($query as $object) {
                $children[] = self::getObject($object['id']);
            }
        }
        return $children;
    }

    // Object properties
    protected $readable = array();      // Array (String[,String[,...]])
    protected $writable = array();      // Array (String[,String[,...]])

    protected $id;                      // Integer
    protected $type;                    // String
    protected $parent = false;          // Boolean false or core object
    protected $children = array();        // Array (core object[,core object[,...]])

    protected $prevent_load_children = false;
    protected $prevent_load_children_2nd = false;
    protected $prevent_load_children_2nd_limit = array();

    protected $sql_type_select = false;

    // Initialize
    public function __construct ($id,$parent,$data) {
        $this->readable = array_merge($this->readable,array(
            'id','type','parent','children'
        ));
        $this->writable = array_merge($this->readable,array(
            'prevent_load_children'=>'is_bool'
        ));
        $this->id = $id;
        $this->parent = $parent;
        $this->parseData($data);
        $this->loadFromDB();
        if (!$this->prevent_load_children) {
            $this->children = self::loadChildren($this->id);
        }
    }

    public function __destruct () {
        // Update db
        $this->saveToDB();
    }

    protected function parseData ($data) {
        foreach ($data as $key => $value) {
            $parser = 'parse'.self::_2camel($key);
            if (method_exists($this,$parser)) {
                $this->$key = $parser($value);
            } elseif (!isset($this->$key)) {
                $this->$key = $value;
            }
        }
    }

    protected function loadFromDB () {
        $query = "SELECT ".($this->sql_select_object?$this->sql_select_object:"*")
            ." FROM ".self::$sql_object_table.'_'.$this->getType()
            ." WHERE id=".$this->id;
        $this->parseData($query);
    }
    protected function saveToDB () {
        $magic = '';
    }

    protected function getType () {
        if (!$this->type) {
            $class = explode('\\',get_class());
            array_walk($class,'ucfirst');
            $this->type = 'object_'.implode('_',$class);
        }
        return $this->type;
    }

    // Universal get readable internal property
    public function __get ($name) {
        if (in_array($this->$name,$this->readable)) {
            $handler = 'get'.self::_2camel($name);
            if (method_exists($this,$handler)) {
                return $this->$handler();
            }
            return $this->$name;
        } else {
            throw new exception('Unreadable Property ('.$name.')');
        }
    }
    // Universal set writable internal property
    public function __set ($name,$value) {

    }

    // Events
    public function callEvent ($name,event $event) {
        $eventHandler = 'event'.self::_2camel($name);
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