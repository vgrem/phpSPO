<?php


namespace Office365\PHP\Client\SharePoint\Taxonomy;

use Office365\PHP\Client\Runtime\ClientObject;
use Office365\PHP\Client\Runtime\ClientRuntimeContext;
use Office365\PHP\Client\Runtime\CSOM\ICSOMCallable;
use Office365\PHP\Client\Runtime\CSOM\ObjectIdentityQuery;
use Office365\PHP\Client\Runtime\ResourcePathServiceOperation;
use SimpleXMLElement;

class TaxonomySession extends ClientObject implements ICSOMCallable
{


    function getServerTypeId()
    {
        return "{981cbc68-9edc-4f8d-872f-71146fcbb84f}";
    }


    /**
     * @param ClientRuntimeContext $ctx
     * @return TaxonomySession
     */
    public function getTaxonomySession(ClientRuntimeContext $ctx)
    {
        if(is_null($ctx))
            throw new \InvalidArgumentException("Context is not initialized");
        $path = new ResourcePathServiceOperation($ctx, null, "GetTaxonomySession", null);
        $path->TypeId = $this->getServerTypeId();
        $path->IsStatic = true;
        $taxonomySession = new TaxonomySession($ctx, $path);
        $objectIdentityQuery = new ObjectIdentityQuery($taxonomySession->getResourcePath());
        $this->context->addQuery($objectIdentityQuery, $taxonomySession);
        $this->context->addQuery($objectIdentityQuery);
        return $taxonomySession;
    }


    function buildQuery(SimpleXMLElement $writer)
    {
        // TODO: Implement buildQuery() method.
    }
}