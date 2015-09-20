<?php

namespace ultrafail\nimbus\universe;

class event {
    public $preventBubbleUp;
    public $preventBubbleDown;
    public $bubbleDownTypes;
    public $data;
    public function __construct ($name,$data=NULL,$preventBubbleUp=true,$preventBubbleDown=true,$bubbleDownTypes=array()) {
        if (!is_string($name)||!strlen($name)) {throw exception('Event requires a valid name');}
        if (is_bool($preventBubbleUp)) {$this->preventBubbleUp = $preventBubbleUp;}
        if (is_bool($preventBubbleDown)) {$this->preventBubbleDown = $preventBubbleDown;}
        if (is_array($bubbleDownTypes)) {$this->bubbleDownTypes = $bubbleDownTypes;}
        if (isset($data)) {$this->data = $data;}
    }
}