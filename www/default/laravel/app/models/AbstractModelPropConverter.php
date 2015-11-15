<?php

use LaravelBook\Ardent\Ardent;

abstract class AbstractModelPropConverter extends Ardent {

    /**
     * Convert the model instance to an array.
     *
     * @return array
     */
    public function toArray() {
        $attributes = $this->attributesToArray();
        $class = get_called_class();
        /* Convert attributes */
        foreach ($attributes as $attr => $val) {
            $method = 'convert_'.$attr;
            if (method_exists($class,$method)) {
                $attributes[$attr] = forward_static_call(array($class,$method),$attributes[$attr],$this);
            }
        }
        return array_merge($attributes, $this->relationsToArray());
    }
}
