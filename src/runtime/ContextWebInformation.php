<?php

namespace SharePoint\PHP\Client\Runtime;

/**
 * The context information for a site.
 */
class ContextWebInformation
{
    /**
     * @param \stdClass $properties
     */
    public function fromJson($properties){
        foreach($properties as $key => $value){
            $this->$key = $value;
        }
    }
    
    /**
     * The form digest value.
     * @var string
     */
    public $FormDigestValue;


    /**
     * The library version.
     * @var string
     */
    public $LibraryVersion;
}