<?php

namespace Office365\PHP\Client\Runtime;

use Office365\PHP\Client\Runtime\OData\ODataFormat;

interface IEntityType
 {
     /**
      * @return string
      */
     function getTypeName();


    /**
     * @return bool
     */
    function getServerObjectIsNull();


    /**
     * @param ODataFormat $format
     * @return mixed
     */
     function toJson(ODataFormat $format);


     /**
      * @param string $name
      * @return mixed
      */
     public function getProperty($name);

    /**
     * @param string $name
     * @param mixed $value
     * @param bool $serializable
     */
     function setProperty($name, $value, $serializable = true);
 }
