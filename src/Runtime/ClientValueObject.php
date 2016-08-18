<?php
/**
 * Represents a local client object model version of a server-side property value.
 */

namespace SharePoint\PHP\Client;

use ReflectionClass;
use ReflectionProperty;
use SharePoint\PHP\Client\Runtime\ODataEntity;
use SharePoint\PHP\Client\Runtime\ODataPayloadKind;
use stdClass;

/**
 * Class ClientValueObject
 */
class ClientValueObject extends ODataEntity
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
     * @return stdClass
     */
    function convertToPayload()
    {
        $reflection = new ReflectionClass($this);
        $allProps = $reflection->getProperties(ReflectionProperty::IS_PUBLIC);
        $payload = new stdClass();
        foreach ($allProps as $p) {
            $k = $p->getName();
            $v = $p->getValue($this);
            if (isset($v)) {
                $payload->{$k} = $v;
            }
        }
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
     * @return int
     */
    function getPayloadType()
    {
        return ODataPayloadKind::Value;
    }

    /**
     * @var string
     */
    private $entityTypeName;



}