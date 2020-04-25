<?php

namespace Office365\Runtime\OData;


abstract class BaseODataReader
{

    /**
     * @param string $edmx
     * @param array $options
     * @return ODataModel
     */
    function generateModel($edmx, $options)
    {
        $model = new ODataModel($options);
        $this->parseEdmx($edmx, $model);
        return $model;
    }


    /**
     * @param string $edmx
     * @param ODataModel $model
     */
    abstract function parseEdmx($edmx, $model);
}
