<?php


namespace Office365\PHP\Client\Runtime;


/**
 * Represents OData complex type(property) of a server-side property value.
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