<?php

namespace Office365\Runtime\OData;


abstract class ODataReader
{

    /**
     * @param array $options
     * @return ODataModel
     */
    function generateModel($options)
    {
        $model = new ODataModel($options);
        $edmx = file_get_contents($options['metadataPath']);
        $this->parseEdmx($edmx, $model);
        return $model;
    }


    /**
     * @param string $edmx
     * @param ODataModel $model
     */
    abstract function parseEdmx($edmx, $model);
}
