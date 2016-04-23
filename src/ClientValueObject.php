<?php
/**
 * Represents a local client object model version of a server-side property value.
 */

namespace SharePoint\PHP\Client;


/**
 * @property  __metadata
 */
class ClientValueObject
{
    
    public function setMetadataType($value)
    {
        $this->__metadata->type = $value;
    }


    public function toJson()
    {
        return json_encode($this);
    }
    
    
    //private $metadataType;

}