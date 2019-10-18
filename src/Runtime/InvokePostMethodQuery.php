<?php

namespace Office365\PHP\Client\Runtime;

class InvokePostMethodQuery extends InvokeMethodQuery
{
    /**
     * ClientActionUpdateMethod constructor.
     * @param ResourcePath $resourcePath
     * @param string $methodName
     * @param array $methodParameters
     * @param string|IEntityType $value
     */
    public function __construct(ResourcePath $resourcePath, $methodName = null, $methodParameters=null, $value=null)
    {
        parent::__construct($resourcePath,$methodName, $methodParameters);
        $this->Value = $value;
    }

    /**
     * @var string|IEntityType $Value
     */
    public $Value;
}
