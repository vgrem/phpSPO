<?php


namespace Office365\PHP\Client\Runtime\OData;


use SimpleXMLIterator;


class ODataV3Reader implements IODataReader
{

    private $options;
    private $content;

    public function __construct($content, $options)
    {
        $this->content = $content;
        $this->options = $options;
    }

    /**
     * @return ODataModel
     */
    function generateModel()
    {
        $model = new ODataModel($this->options);
        $this->parseEdmx($model);
        return $model;
    }


    function parseEdmx(ODataModel $model, SimpleXMLIterator &$parentNode = null, SimpleXMLIterator &$prevNode = null, $prevValue=null){
        if(is_null($parentNode)){
            $parentNode = new SimpleXMLIterator($this->content);
            $parentNode->registerXPathNamespace('edmx', 'http://schemas.microsoft.com/ado/2007/06/edmx');
            $dataServices = $parentNode->xpath("///edmx:DataServices");
            $curNode = $dataServices[0];
        }
        else {
            $curNode = new SimpleXMLIterator($prevNode->asXML());
        }

        /** @var SimpleXMLIterator $childNode */
        foreach ($curNode as $childNode) {
            $nodeName = $childNode->getName();
            switch ($nodeName) {
                case "ComplexType":
                case "EntityType":
                    $nsName = (string)$prevNode->attributes()["Namespace"];
                    $typeName = (string)$childNode->attributes()["Name"];
                    $typeFullName = "$nsName.$typeName";
                    $baseTypeName =  ($nodeName === 'ComplexType' ? "ClientValueObject" : "ClientObject");
                    if($model->resolveType($typeFullName,$baseTypeName)){
                        if(is_null($childNode->getChildren())) {
                            $this->parseEdmx($model,$curNode,$childNode,$typeFullName);
                        }
                    }
                    break;
                case "Property":
                    if($prevValue){
                        $propName = (string)$childNode->attributes()["Name"];
                        $typeName = (string)$childNode->attributes()["Type"];
                        $propFullName = "$prevValue.$propName";
                        $model->resolveProperty($propFullName,$typeName);
                    }
                    break;
                case "NavigationProperty":
                    $propName = (string)$childNode->attributes()["Name"];
                    $typeName = $this->getPropertyType($childNode,$parentNode,$propName);
                    $fullName = "$prevValue.$propName";
                    $baseTypeName = $this->getPropertyBaseType($parentNode,$propName);

                    if($model->resolveType($typeName,$baseTypeName)){
                        $type = $model->getTypes()[$typeName];
                        if($type['state'] === 'attached')
                            $model->resolveProperty($fullName,$typeName,$baseTypeName);
                    }
                    break;
                default:
                    if(is_null($childNode->getChildren())) {
                        $this->parseEdmx($model,$parentNode,$childNode);
                    }
                    break;
            }
        }
    }

    private function getPropertyBaseType(SimpleXMLIterator $schemaNode, $name)
    {
        $entities = $schemaNode->xpath("////xmlns:EntityType[@Name='$name']");
        if($entities)
            return "ClientObject";
        return "ClientValueObject";
    }

    private function getPropertyType(SimpleXMLIterator $propertyNode, SimpleXMLIterator $schemaNode, $name){
        $schemaNode->registerXPathNamespace('xmlns', 'http://schemas.microsoft.com/ado/2009/11/edm');
        $relationship = explode('.',(string)$propertyNode->attributes()['Relationship']);
        $associations = $schemaNode->xpath("////xmlns:Association[@Name='$relationship[1]']/xmlns:End[@Role='$name']");
        if($associations){
            $multiplicity = (string)$associations[0]->attributes()['Multiplicity'];
            if($multiplicity === "*")
                return "Collection(" . (string)$associations[0]->attributes()['Type'] . ")";
            return (string)$associations[0]->attributes()['Type'];
        }



        return null;
    }
}
