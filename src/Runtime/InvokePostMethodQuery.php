<?php

namespace Office365\PHP\Client\Runtime;



class InvokePostMethodQuery extends InvokeMethodQuery
{

    /**
     * ClientActionUpdateMethod constructor.
     * @param ResourcePath $resourcePath
     * @param string $methodName
     * @param array $methodParameters
     * @param string|IEntityType $methodBody
     */
    public function __construct(ResourcePath $resourcePath, $methodName = null, $methodParameters=null, $methodBody=null)
    {
        $this->MethodBody = $methodBody;
        parent::__construct($resourcePath,$methodName, $methodParameters);
    }



    /**
     * @var string|IEntityType $MethodBody
     */
    public $MethodBody;
    

}