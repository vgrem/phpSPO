<?php


namespace Office365\SharePoint\Taxonomy;


use Office365\Runtime\Auth\AuthenticationContext;
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
     * @var AuthenticationContext
     */
    private $authContext;

    /**
     * @var string
     */
    private $baseUrl;

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
        $this->authContext = $ctx->getAuthenticationContext();
        $this->baseUrl = $ctx->getBaseUrl();
        parent::__construct();
    }

    public function getServiceRootUrl()
    {
        return  "{$this->baseUrl}/_api/v2.1/";
    }

    public function getPendingRequest()
    {
        if(!$this->pendingRequest){
            $format = new JsonFormat(ODataMetadataLevel::MinimalMetadata);
            $this->pendingRequest = new ODataRequest($this,$format);
        }
        return $this->pendingRequest;
    }

    /**
     * @throws \Exception
     */
    public function authenticateRequest(RequestOptions $options)
    {
        $this->authContext->authenticateRequest($options);
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