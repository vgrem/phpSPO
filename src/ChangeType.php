<?php

namespace SharePoint\PHP\Client;


use ReflectionClass;

class ChangeType
{
    const NoChange = 0;
    const Add = 1;
    const Update = 2;
    const DeleteObject = 3;
    const Rename = 4;


    public static function toString($value){
        $reflection = new ReflectionClass(get_called_class());
        $enums = array_flip($reflection->getConstants());
        return $enums[$value];
    }
}