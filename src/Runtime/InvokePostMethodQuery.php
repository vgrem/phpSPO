<?php

namespace Office365\PHP\Client\Runtime;


use Office365\PHP\Client\Runtime\Utilities\RequestOptions;

class InvokePostMethodQuery extends InvokeMethodQuery
{
    /**
     * ClientActionUpdateMethod constructor.
     * @param ResourcePath $resourcePath
     * @param string $methodName
     * @param array $methodParameters
     * @param string|IEntityType $payload
     */
    public function __construct(ResourcePath $resourcePath, $methodName = null, $methodParameters=null, $payload=null)
    {
        parent::__construct($resourcePath,$methodName, $methodParameters);
        $this->payload = $payload;
    }


    /**
     * @return RequestOptions
     */
    public function buildRequest()
    {
        $request = parent::buildRequest();
        $request->Method = HttpMethod::Post;
        if ($this->payload) {
            if (is_string($this->payload))
                $request->Data = $this->payload;
            else {
                $payload = $this->normalizePayload($this->payload, $this->getContext()->getFormat());
                $request->Data = json_encode($payload);
            }
        }
        return $request;
    }

    /**
     * @var string|IEntityType $payload
     */
    protected $payload;
}
