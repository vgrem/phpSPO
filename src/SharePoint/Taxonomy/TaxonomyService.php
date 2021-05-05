<?php


namespace Office365\SharePoint\Taxonomy;


use Office365\Runtime\ClientRuntimeContext;
use Office365\Runtime\Http\RequestOptions;
use Office365\Runtime\OData\JsonFormat;
use Office365\Runtime\OData\ODataMetadataLevel;
use Office365\Runtime\OData\ODataRequest;
use Office365\Runtime\ResourcePath;
use Office365\SharePoint\ClientContext;

class TaxonomyService extends ClientRuntimeContext
{
    /**
     * @var ClientContext
     */
    private $context;

    /**
     * @var ODataRequest
     */
    private $pendingRequest;

    /**
     * @var TermStore
     */
    private $termStore;


    public function __construct(ClientContext  $ctx)
    {
        $this->context = $ctx;
        parent::__construct();
    }

    public function getServiceRootUrl()
    {
        return  "{$this->context->getBaseUrl()}/_api/v2.1/";
    }

    /**
     * @param $credential
     * @return self
     */
    public function withCredentials($credential){
        $this->context->withCredentials($credential);
        return $this;
    }


    /**
     * @return ODataRequest
     */
    public function getPendingRequest()
    {
        if(!$this->pendingRequest){
            $format = new JsonFormat(ODataMetadataLevel::MinimalMetadata);
            $this->pendingRequest = new ODataRequest($this,$format);
        }
        return $this->pendingRequest;
    }

    /**
     * @param RequestOptions $options
     */
    public function authenticateRequest(RequestOptions $options)
    {
        $this->context->authenticateRequest($options);
    }

    /**
     * @return TermStore
     */
    public function getTermStore(){
        if(!isset($this->termStore))
            $this->termStore = new TermStore($this,new ResourcePath("termStore"));
        return $this->termStore;
    }

}