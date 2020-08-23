<?php


namespace Office365\SharePoint\Taxonomy;

use InvalidArgumentException;
use Office365\Runtime\ClientObject;
use Office365\Runtime\ClientRuntimeContext;
use Office365\Runtime\CSOM\ICSOMCallable;
use Office365\Runtime\Actions\InvokePostMethodQuery;
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
            throw new InvalidArgumentException("Context is not initialized");
        $qry = new InvokePostMethodQuery($this, null, "GetTaxonomySession", null,null);
        $qry->TypeId = $this->getServerTypeId();
        $qry->IsStatic = true;
        $taxonomySession = new TaxonomySession($ctx);
        $this->context->addQuery($qry);
        return $taxonomySession;
    }


    function buildQuery(SimpleXMLElement $writer)
    {
        // TODO: Implement buildQuery() method.
    }
}