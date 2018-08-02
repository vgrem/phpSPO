<?php

namespace Office365\PHP\Client\Runtime;

define ("SCHEMA_ALL_PROPERTIES", 1);
define ("SCHEMA_SERIALIZABLE_PROPERTIES", 2);


 interface IEntityType
 {
     /**
      * @return string
      */
     function getTypeName();


     /**
      * @param int $flag
      * @return mixed
      */
     function getProperties($flag=SCHEMA_ALL_PROPERTIES);


     /**
      * @param string $name
      * @return mixed
      */
     public function getProperty($name);

     /**
      * @param string $name
      * @param mixed $value
      * @param bool $persistChanges
      */
     function setProperty($name, $value, $persistChanges = true);
 }