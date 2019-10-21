<?php

namespace Office365\PHP\Client\Runtime;
use Office365\PHP\Client\Runtime\OData\ODataFormat;
use Office365\PHP\Client\Runtime\OData\ODataQueryOptions;
use Office365\PHP\Client\Runtime\Utilities\RequestOptions;


/**
 * OData query class
 */
class ClientAction
{

    /**
     * @var ResourcePath
     */
    protected $resourcePath;


    /**
     * @var $queryOptions ODataQueryOptions
     */
    protected $queryOptions;


    /**
     * ClientAction constructor.
     * @param ResourcePath $resourcePath
     */
    public function __construct(ResourcePath $resourcePath)
    {
        $this->resourcePath = $resourcePath;
    }

    /**
     * @return string
     */
    public function getId(){
        return spl_object_hash($this);
    }


    /**
     * @return ResourcePath
     */
    public function getResourcePath(){
        return $this->resourcePath;
    }


    /**
     * @return ODataQueryOptions
     */
    public function getQueryOptions(){
        return $this->queryOptions;
    }


    /**
     * Build request from query
     * @return RequestOptions
     */
    public function buildRequest(){
        $path = $this->getResourcePath();
        $resourceUrl = $this->getContext()->getServiceRootUrl() . $path->toUrl();
        if (!is_null($this->getQueryOptions())) {
            $resourceUrl .= '?' . $this->getQueryOptions()->toUrl();
        }
        $request = new RequestOptions($resourceUrl);

        if($path instanceof ResourcePathServiceOperation){
            if($path->getMethodParameters() instanceof IEntityType){
                $request->Method = HttpMethod::Post;
                $payload = $this->normalizePayload($path->getMethodParameters(),$this->getContext()->getFormat());
                $request->Data = json_encode($payload);
            }
        }
        return $request;
    }

    /**
     * @return ClientRuntimeContext
     */
    protected function getContext(){
        return $this->resourcePath->getContext();
    }

    /**
     * @param IEntityType|array $value
     * @param ODataFormat $format
     * @return array
     */
    protected function normalizePayload($value,ODataFormat $format)
    {
        if ($value instanceof IEntityType) {
            $payload = array_map(function ($property) use($format){
                return $this->normalizePayload($property,$format);
            }, $value->toJson($format));
            return $payload;
        } else if (is_array($value)) {
            return array_map(function ($item) use($format){
                return $this->normalizePayload($item,$format);
            }, $value);
        }
        return $value;
    }

}

