<?php

class Changelog extends AbstractModelPropConverter {
	protected $table = 'changelog';

    public static $relationsData = array(
        'user_id' => array(self::BELONGS_TO, 'User')
    );
}
