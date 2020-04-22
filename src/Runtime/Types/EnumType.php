<?php


namespace Office365\Runtime\Types;

use Exception;
use ReflectionClass;

abstract class EnumType
{

    /**
     * @param $value string
     * @return string |null
     */
    public static function getName($value){
        try{
            $reflection = new ReflectionClass(get_called_class());
            $enums = array_flip($reflection->getConstants());
            return $enums[$value];
        }
        catch (Exception $ex){
            return null;
        }
    }

    public static function getNames(){
        $reflection = new ReflectionClass(get_called_class());
        $enums = $reflection->getConstants();
        return array_keys($enums);
    }


    public static function getValues(){
        $reflection = new ReflectionClass(get_called_class());
        $enums = $reflection->getConstants();
        return array_values($enums);
    }
}
