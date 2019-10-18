<?php


namespace Office365\PHP\Client\Runtime;


class InvokeMethodQuery extends ClientAction
{
    /**
     * @var string|null
     */
    private $methodName;

    /**
     * InvokeMethodQuery constructor.
     * @param ResourcePath $resourcePath
     * @param string $methodName
     * @param array|IEntityType $methodParameters
     */
    public function __construct(ResourcePath $resourcePath, $methodName=null, $methodParameters=null)
    {
        parent::__construct(new ResourcePathServiceOperation(
            $resourcePath->getContext(),
            $resourcePath,
            $methodName,
            $methodParameters
        ));
        $this->methodName = $methodName;
    }

    /*protected function toXmlQuery(SimpleXMLElement $writer){
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
    }*/

    /**
     * @return string|null
     */
    public function getMethodName(){
        return $this->methodName;
    }


}
