<?php


namespace Office365\PHP\Client\Runtime;


use SimpleXMLElement;

class InvokeMethodQuery extends ClientAction
{

    /**
     * InvokeMethodQuery constructor.
     * @param ResourcePath $resourcePath
     * @param string $methodName
     * @param array|IEntityType $methodParameters
     */
    public function __construct(ResourcePath $resourcePath, $methodName=null, $methodParameters=null)
    {

        $path = new ResourcePathServiceOperation(
            $resourcePath->getContext(),
            $resourcePath,
            $methodName,
            $methodParameters
        );

        parent::__construct($path);
        $this->MethodName = $methodName;
        $this->MethodParameters = $methodParameters;
    }



    protected function toXmlQuery(SimpleXMLElement $writer){
        $method = $writer->addChild("Method");
        $method->addAttribute("Name", $this->MethodName);
        $method->addAttribute("Id", $this->getId());
        $method->addAttribute("ObjectPathId", $this->getResourcePath()->Id);
        if (isset($this->Version))
            $method->addAttribute("Version", $this->Version);
        if(isset($this->MethodParameters)){
            //$parameters = $method->addChild("Parameters");
            foreach ($this->MethodParameters as $parameter){
                //$parameter = $parameters->addChild("Parameter");

            }
        }
    }


    /**
     * @var $MethodName string
     */
    public $MethodName;


    /**
     * @var $MethodParameters array|IEntityType
     */
    public $MethodParameters;


    /**
     * @var $Version string
     */
    public $Version;
}