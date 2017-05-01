<?php


namespace Office365\PHP\Client\SharePoint\Taxonomy;

use Office365\PHP\Client\Runtime\ClientObject;
use Office365\PHP\Client\Runtime\ClientRuntimeContext;

class TaxonomySession extends ClientObject
{


    function getServerTypeId()
    {
        return "{981cbc68-9edc-4f8d-872f-71146fcbb84f}";
    }



    public function getTaxonomySession(ClientRuntimeContext $ctx)
    {
        if(is_null($ctx))
            throw new \InvalidArgumentException("Context is not initialized");
    }
}