<?php


namespace Office365\Runtime\OData;


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
                    $typeSchema = $this->processTypeNode($childNode, $prevNode);
                    if ($model->resolveType($typeSchema)) {
                        if (is_null($childNode->getChildren())) {
                            $this->parseEdmx($model, $curNode, $childNode, $typeSchema);
                        }
                    }
                    break;
                case "FunctionImport":
                    $funcSchema = $this->processFunctionNode($childNode, $parentNode);
                    if ($model->resolveFunction($funcSchema)) {
                        $this->parseEdmx($model, $curNode, $childNode, $funcSchema);
                    }
                    break;
                case "Parameter":
                    $parameterSchema = array(
                        'type' => (string)$childNode->attributes()["Type"],
                        'name' => (string)$childNode->attributes()["Name"]
                    );
                    $model->resolveParameter($prevValue, $parameterSchema);
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
                        $this->parseEdmx($model, $parentNode, $childNode);
                    }
                    break;
            }
        }
    }

    private function processTypeNode(SimpleXMLIterator $curNode, SimpleXMLIterator $parentNode)
    {
        $schema = array(
            'alias' => (string)$curNode->attributes()["Name"],
            'baseType' => ($curNode->getName() === 'ComplexType' ? "ClientValueObject" : "ClientObject"),
            'properties' => array()
        );
        $schema['name'] = (string)$parentNode->attributes()["Namespace"] . "." . $schema['alias'];
        return $schema;
    }


    private function processFunctionNode(SimpleXMLIterator $curNode, SimpleXMLIterator $parentNode)
    {
        $parentNode->registerXPathNamespace('xmlns', 'http://schemas.microsoft.com/ado/2009/11/edm');
        $funcAlias = (string)$curNode->attributes()["Name"];
        $returnType = (string)$curNode->attributes()["ReturnType"];
        $entitySet = (string)$curNode->attributes()["EntitySet"];
        $isBindable = (string)$curNode->attributes()["IsBindable"] !== "";
        $result = $parentNode->xpath("////xmlns:EntityContainer[@Name='ApiData']/xmlns:EntitySet[@Name='$entitySet']");
        $typeName = null;
        if($result){
            $typeName = (string)$result[0]->attributes()['EntityType'];
        }
        return array('alias' => $funcAlias,'returnType' => $returnType, 'name' => $typeName, 'parameters' => array(), 'isBindable' => $isBindable);
    }


    private function processPropertyNode(SimpleXMLIterator $curNode, SimpleXMLIterator $parentNode,$isNavigation)
    {
        if(!$isNavigation){
            return array(
                'name' => (string)$curNode->attributes()["Name"],
                'type' => (string)$curNode->attributes()["Type"]
            );
        }
        $propAlias = (string)$curNode->attributes()["Name"];
        $propType = $this->findPropertyType($curNode, $parentNode, $propAlias);
        $baseType = $this->findBaseType($parentNode,$propType);
        return array(
            'name' => $propAlias,
            'type' => $propType,
            'baseType' => $baseType,
            'readOnly' => true
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
