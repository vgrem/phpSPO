<?php


namespace SharePoint\PHP\Client;

use ReflectionClass;

class Enum
{

    public static function getName($value){
        $reflection = new ReflectionClass(get_called_class());
        $enums = array_flip($reflection->getConstants());
        return $enums[$value];
    }

}