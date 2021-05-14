<?php


namespace Office365\Runtime\OData\V4;


use Office365\Runtime\OData\ODataReader;
use SimpleXMLIterator;

class ODataV4Reader extends ODataReader
{

    function parseEdmx($edmx, $model, SimpleXMLIterator &$parentNode = null, SimpleXMLIterator &$prevNode = null, $prevValue=null)
    {
        if (is_null($parentNode)) {
            $parentNode = new SimpleXMLIterator($edmx);
            $parentNode->registerXPathNamespace('edmx', 'http://docs.oasis-open.org/odata/ns/edmx');
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
                    $typeSchema = $this->processTypeNode($childNode, $prevNode);
                    if ($model->resolveType($typeSchema)) {
                        if (is_null($childNode->getChildren())) {
                            $this->parseEdmx($edmx, $model, $curNode, $childNode, $typeSchema);
                        }
                    }
                    break;
                case "Action":
                    break;
                case "Property":
                    if ($prevValue) {
                        $propertySchema = $this->processPropertyNode($childNode, $parentNode);
                        $model->resolveProperty($prevValue, $propertySchema);
                    }
                    break;
                case "NavigationProperty":
                    $propertySchema = $this->processPropertyNode($childNode, $parentNode);
                    if (!is_null($propertySchema['type'])) {
                        $model->resolveProperty($prevValue, $propertySchema);
                    }
                    break;
                default:
                    if (is_null($childNode->getChildren())) {
                        $this->parseEdmx($edmx,$model, $parentNode, $childNode);
                    }
                    break;
            }
        }
    }


    /**
     * @param string $name
     * @return string
     */
    private function normalizeName($name){
        $names = explode(".", $name);
        $names = array_map(function ($n){
            return ucfirst($n);
        }, $names);
        $name = implode("." ,$names);
        if (substr($name, 0, strlen("Collection")) === "Collection") {
            $names = explode("(", $name);
            $names[1] = ucfirst($names[1]);
            $name = implode("(" ,$names);
        }
        return $name;
    }


    /**
     * @param SimpleXMLIterator $curNode
     * @param SimpleXMLIterator $parentNode
     * @return array
     */
    private function processTypeNode(SimpleXMLIterator $curNode, SimpleXMLIterator $parentNode)
    {
        return array(
            'name' => $this->normalizeName((string)$parentNode->attributes()["Namespace"] . "." . (string)$curNode->attributes()["Name"]),
            'alias' => ucfirst ((string)$curNode->attributes()["Name"]),
            'baseType' => $curNode->getName(),
            'baseTypeAs' => $curNode->attributes()["BaseType"] ? $this->normalizeName((string)$curNode->attributes()["BaseType"]) : null,
            'properties' => array()
        );
    }

    private function processPropertyNode(SimpleXMLIterator $curNode, SimpleXMLIterator $parentNode)
    {
        return array(
            'name' => ucfirst((string)$curNode->attributes()["Name"]),
            'type' => $this->normalizeName((string)$curNode->attributes()["Type"]),
            'baseType' => $this->normalizeName((string)$curNode->attributes()["Type"]),
            'readOnly' => $curNode->getName() === "NavigationProperty"
        );
    }

}