<?php


namespace Office365\Runtime\OData;


use SimpleXMLIterator;

class ODataV4Reader extends BaseODataReader
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
                        $propertySchema = $this->processPropertyNode($childNode, $parentNode,false);
                        $model->resolveProperty($prevValue, $propertySchema);
                    }
                    break;
                case "NavigationProperty":
                    $propertySchema = $this->processPropertyNode($childNode, $parentNode,true);
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


    private function processTypeNode(SimpleXMLIterator $curNode, SimpleXMLIterator $parentNode)
    {
        $names = explode(".",(string)$parentNode->attributes()["Namespace"]);
        array_push($names,(string)$curNode->attributes()["Name"]);
        $names = array_map(function ($n){
            return ucfirst($n);
        }, $names);
        $fqn = implode("." ,$names);

        return array(
            'name' => $fqn,
            'alias' => ucfirst ((string)$curNode->attributes()["Name"]),
            'baseType' => ($curNode->getName() === 'ComplexType' ? "ClientValueObject" : "ClientObject"),
            'properties' => array()
        );
    }

    private function processPropertyNode(SimpleXMLIterator $curNode, SimpleXMLIterator $parentNode,$isNavigation)
    {
        return array(
            'name' => (string)$curNode->attributes()["Name"],
            'type' => (string)$curNode->attributes()["Type"],
            'baseType' => $this->findBaseType($parentNode,(string)$curNode->attributes()["Type"]),
            'readOnly' => $isNavigation
        );
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

        $schemaNode->registerXPathNamespace('xmlns', 'http://docs.oasis-open.org/odata/ns/edm');
        $result = $schemaNode->xpath("///xmlns:Schema[@Namespace='$typeNs']/xmlns:EntityType[@Name='$typeAlias']");
        if ($result)
            return $isCollection ? "ClientObjectCollection" : "ClientObject";
        $result = $schemaNode->xpath("///xmlns:Schema[@Namespace='$typeNs']/xmlns:ComplexType[@Name='$typeAlias']");
        if ($result)
            return $isCollection ? "ClientValueObjectCollection" : "ClientValueObject";
        return null;
    }
}