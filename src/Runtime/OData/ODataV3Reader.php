<?php


namespace Office365\PHP\Client\Runtime\OData;


class ODataV3Reader implements IODataReader
{

    function generateModel($content)
    {
        $model = new ODataModel();
        $edmx = simplexml_load_string($content);
        $edmx->registerXPathNamespace('edmx', 'http://schemas.microsoft.com/ado/2007/06/edmx');
        $dataServices = $edmx->xpath("///edmx:DataServices");
        $dataService = $dataServices[0];
        foreach ($dataService as $schema) {
            $nsName = (string)$schema->attributes()["Namespace"];
            foreach ($schema as $type) {
                $typeName = $nsName . "." .  (string)$type->attributes()["Name"];
                $model->addType($typeName);
            }
        }
        return $model;
    }
}