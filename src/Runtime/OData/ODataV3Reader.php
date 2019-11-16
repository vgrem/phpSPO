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


    function parseEdmx(ODataModel $model, SimpleXMLIterator &$parentNode = null, SimpleXMLIterator &$prevNode = null, $prevValue=null)
    {
        if (is_null($parentNode)) {
            $parentNode = new SimpleXMLIterator($this->content);
            $parentNode->registerXPathNamespace('edmx', 'http://schemas.microsoft.com/ado/2007/06/edmx');
            $dataServices = $parentNode->xpath("///edmx:DataServices");
            $curNode = $dataServices[0];
        } else {
            $curNode = new SimpleXMLIterator($prevNode->asXML());
        }

        /** @var SimpleXMLIterator $childNode */
        foreach ($curNode as $childNode) {
            $nodeName = $childNode->getName();
            switch ($nodeName) {
                case "ComplexType":
                case "EntityType":
                    $nsName = (string)$prevNode->attributes()["Namespace"];
                    $alias = (string)$childNode->attributes()["Name"];
                    $typeName = "$nsName.$alias";
                    $baseType = ($nodeName === 'ComplexType' ? "ClientValueObject" : "ClientObject");
                    if ($model->resolveType($typeName, $baseType)) {
                        if (is_null($childNode->getChildren())) {
                            $this->parseEdmx($model, $curNode, $childNode, $typeName);
                        }
                    }
                    break;
                case "Property":
                    if ($prevValue) {
                        $propAlias = (string)$childNode->attributes()["Name"];
                        $propType = (string)$childNode->attributes()["Type"];
                        $propName = "$prevValue.$propAlias";
                        $baseType = ($prevNode->getName() === 'ComplexType' ? "ClientValueObject" : "ClientObject");
                        $model->resolveProperty($propName, $propType,$baseType);
                    }
                    break;
                case "NavigationProperty":
                    $propAlias = (string)$childNode->attributes()["Name"];
                    $propType = $this->findPropertyType($childNode, $parentNode, $propAlias);
                    $baseType = $this->findBaseType($parentNode,$propType);
                    $propName = "$prevValue.$propAlias";
                    if(!is_null($propType)) {
                        $model->resolveProperty($propName, $propType, $baseType, true);
                    }
                    break;
                default:
                    if (is_null($childNode->getChildren())) {
                        $this->parseEdmx($model, $parentNode, $childNode);
                    }
                    break;
            }
        }
    }

    private function findBaseType(SimpleXMLIterator $schemaNode, $typeName)
    {
        $isCollection = false;
        $collTag = "Collection";
        if (substr($typeName, 0, strlen($collTag)) === $collTag) {
            $isCollection = true;
            $typeName = str_replace(")", "", str_replace("Collection(", "", $typeName));
        }
        $parts = explode('.', $typeName);
        $typeAlias = array_pop($parts);
        $typeNs = implode(".",$parts);

        $result = $schemaNode->xpath("///xmlns:Schema[@Namespace='$typeNs']/xmlns:EntityType[@Name='$typeAlias']");
        if ($result)
            return $isCollection ? "ClientObjectCollection" : "ClientObject";
        $result = $schemaNode->xpath("///xmlns:Schema[@Namespace='$typeNs']/xmlns:ComplexType[@Name='$typeAlias']");
        if ($result)
            return $isCollection ? "ClientValueObjectCollection" : "ClientValueObject";
        return null;
    }

    private function findPropertyType(SimpleXMLIterator $propertyNode, SimpleXMLIterator $schemaNode, $name){
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
