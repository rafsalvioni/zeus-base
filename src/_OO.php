<?php

/**
 * Try to set a object property
 * 
 * If theres a "setter" method, it will be called. Else, try to set property
 * directally
 * 
 * @param object $obj Object
 * @param string $prop Property name
 * @param mixed $value Value to be setted
 * @param string $prefix Setter template (like to sprintf)
 * @return void
 */
function object_setter(object $obj, string $prop, mixed $value, string $prefix = 'set%s'): void
{
    $setter = \sprintf($prefix, $prop);
    if (method_exists($obj, $setter)) {
        $obj->{$setter}($value);
    }
    else {
        $obj->$prop = $value;
    }
}

/**
 * Try to get a object property
 * 
 * If theres a "getter" method, it will be called. Else, try to get property
 * directally
 * 
 * @param object $obj Object
 * @param string $prop Property name
 * @param string $prefix Getter template (like to sprintf)
 * @return mixed
 */
function object_getter(object $obj, string $prop, string $prefix = 'get%s'): mixed
{
    $getter = \sprintf($prefix, $prop);
    if (method_exists($obj, $getter)) {
        return $obj->{$getter}();
    }
    return $obj->$prop;
}
