<?php


namespace Office365\PHP\Client\Runtime\OData;


class ODataV3Reader implements IODataReader
{

    /**
     * @param $content string
     * @return ODataModel
     */
    function generateModel($content)
    {
        $model = new ODataModel();
        $edmx = simplexml_load_string($content);
        $edmx->registerXPathNamespace('edmx', 'http://schemas.microsoft.com/ado/2007/06/edmx');
        $dataServices = $edmx->xpath("///edmx:DataServices");
        $dataService = $dataServices[0];
        foreach ($dataService as $schema) {
            $typeNs = (string)$schema->attributes()["Namespace"];
            foreach ($schema->ComplexType as $type) {
                $typeName = (string)$type->attributes()["Name"];
                $typeProps = [];
                foreach ($type->Property as $prop) {
                   $typeProps[(string)$prop->attributes()["Name"]] = (string)$prop->attributes()["Type"];
                }
                $typeFullName = "$typeNs.$typeName";
                $model->tryResolveType($typeFullName,$typeProps);
            }
        }
        return $model;
    }


}
