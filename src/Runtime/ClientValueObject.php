<?php
/**
 * Represents a local client object model version of a server-side property value.
 */

namespace SharePoint\PHP\Client;

use ReflectionClass;
use ReflectionProperty;
use SharePoint\PHP\Client\Runtime\ODataPayload;
use SharePoint\PHP\Client\Runtime\ODataPayloadKind;
use stdClass;

/**
 * Class ClientValueObject
 */
class ClientValueObject
{

    /**
     * ClientValueObject constructor.
     * @param string $entityName
     */
    public function __construct($entityName = null)
    {
        $this->entityTypeName = $entityName;
    }

    /**
     * Generates OData payload
     * @return ODataPayload
     */
    function convertToPayload()
    {
        $reflection = new ReflectionClass($this);
        $allProps = $reflection->getProperties(ReflectionProperty::IS_PUBLIC);
        $payloadValue = new stdClass();
        foreach ($allProps as $p) {
            $k = $p->getName();
            $v = $p->getValue($this);
            if (isset($v)) {
                $payloadValue->{$k} = $v;
            }
        }
        $payload = new ODataPayload($payloadValue,ODataPayloadKind::Property,$this->getEntityTypeName());
        return $payload;
    }



    public function getEntityTypeName()
    {
        if(!isset($this->entityTypeName)){
            $typeInfo = explode("\\",get_class($this));
            $this->entityTypeName =  end($typeInfo);
        }
        return $this->entityTypeName;
    }


    /**
     * @var string
     */
    private $entityTypeName;



}