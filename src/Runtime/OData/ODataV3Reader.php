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


    function parseEdmx(ODataModel $model, SimpleXMLIterator &$prevIterator = null, $prevValue=null){
        if(is_null($prevIterator)){
            $iterator = new SimpleXMLIterator($this->content);
            $iterator->registerXPathNamespace('edmx', 'http://schemas.microsoft.com/ado/2007/06/edmx');
            $dataServices = $iterator->xpath("///edmx:DataServices");
            $iterator = $dataServices[0];
        }
        else {
            $iterator = new SimpleXMLIterator($prevIterator->asXML());
        }

        /** @var SimpleXMLIterator $node */
        foreach ($iterator as $node) {
            $nodeName = $node->getName();
            switch ($nodeName) {
                case "ComplexType":
                case "EntityType":
                    $nsName = (string)$prevIterator->attributes()["Namespace"];
                    $typeName = (string)$node->attributes()["Name"];
                    $typeFullName = "$nsName.$typeName";
                    if($model->resolveType($typeFullName)){
                        if(is_null($node->getChildren())) {
                            $this->parseEdmx($model,$node,$typeFullName);
                        }
                    }
                    break;
                case "Property":
                    if($prevValue){
                        $propName = (string)$node->attributes()["Name"];
                        $propTypeName = (string)$node->attributes()["Type"];
                        $propFullName = "$prevValue.$propName";
                        $model->resolveProperty($propFullName,$propTypeName);
                    }
                    break;
                default:
                    if(is_null($node->getChildren())) {
                        $this->parseEdmx($model,$node);
                    }
                    break;
            }
        }
    }

}
