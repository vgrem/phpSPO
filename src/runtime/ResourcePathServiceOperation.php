<?php


namespace SharePoint\PHP\Client;
use SharePoint\PHP\Client\Runtime\ODataPathParser;

/**
 * Resource path to address Service Operations which represents simple functions exposed by an OData service
 */
class ResourcePathServiceOperation extends ResourcePath
{
    /**
     * ResourcePathMethod constructor.
     * @param ClientContext $context
     * @param ResourcePath $parent
     * @param string $methodName
     * @param array $methodParameters
     */
    public function __construct(ClientContext $context, ResourcePath $parent, $methodName, $methodParameters = null)
    {
        parent::__construct($context, $parent);
        $this->methodName = $methodName;
        $this->methodParameters = $methodParameters;
    }


    protected function getValue()
    {
        return ODataPathParser::fromMethod($this->methodName,$this->methodParameters);
    }

    public function getPayload()
    {
       if($this->methodParameters instanceof ClientValueObject || $this->methodParameters instanceof ClientObject)
          return $this->methodParameters->toJson();
        return json_encode($this->methodParameters);
    }


    /**
     * @var array
     */
    protected $methodParameters;

    /**
     * @var string
     */
    protected $methodName;

}