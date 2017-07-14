<?php


namespace Office365\PHP\Client\Runtime;
use Office365\PHP\Client\Runtime\CSOM\ICSOMCallable;
use Office365\PHP\Client\Runtime\OData\ODataPathParser;
use SimpleXMLElement;

/**
 * Resource path to address Service Operations which represents simple functions exposed by an OData service
 */
class ResourcePathServiceOperation extends ResourcePath implements ICSOMCallable
{
    /**
     * ResourcePathMethod constructor.
     * @param ClientRuntimeContext $context
     * @param ResourcePath $parent
     * @param string $methodName
     * @param array $methodParameters
     */
    public function __construct(ClientRuntimeContext $context, ResourcePath $parent, $methodName, $methodParameters = null)
    {
        parent::__construct($context, $parent);
        $this->methodName = $methodName;
        $this->methodParameters = $methodParameters;
    }


    public function getName()
    {
        return ODataPathParser::fromMethod($this->methodName,$this->methodParameters);
    }


    function buildQuery(SimpleXMLElement $writer)
    {
        /*$method = $writer->addChild("Method");
        $method->addAttribute("Id", $this->Id);
        $method->addAttribute("ParentId", $this->parent->Id);
        $method->addAttribute("Name", $this->methodName);
        if(isset($this->MethodParameters)){
            $parameters = $method->addChild("Parameters");
            foreach ($this->MethodParameters as $parameter){
                $parameter = $parameters->addChild("Parameter");

            }
        }*/
    }

    /**
     * @var array
     */
    protected $methodParameters;

    /**
     * @var string
     */
    protected $methodName;


    /**
     * @var string
     */
    public $TypeId;


    /**
     * @var $IsStatic boolean
     */
    public $IsStatic;


}