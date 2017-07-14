<?php


namespace Office365\PHP\Client\Runtime;


use SimpleXMLElement;

abstract class ClientActionInvokeMethod extends ClientAction
{


    /**
     * ClientActionInvokeMethod constructor.
     * @param ClientObject $parentClientObject
     * @param string $methodName
     * @param array $actionParameters
     * @param mixed $requestPayload
     * @param int $actionType
     */
    public function __construct(ClientObject $parentClientObject, $methodName=null, array $actionParameters=null, $requestPayload = null, $actionType = ClientActionType::GetMethod)
    {
        $path = new ResourcePathServiceOperation(
            $parentClientObject->getContext(),
            $parentClientObject->getResourcePath(),
            $methodName,
            $actionParameters
        );
        parent::__construct($path,$requestPayload,$actionType);
        $this->MethodName = $methodName;
        $this->MethodParameters = $actionParameters;
    }



    protected function toXmlQuery(SimpleXMLElement $writer){
        $method = $writer->addChild("Method");
        $method->addAttribute("Name", $this->MethodName);
        $method->addAttribute("Id", $this->getId());
        $method->addAttribute("ObjectPathId", $this->ResourcePath->Id);
        if (isset($this->Version))
            $method->addAttribute("Version", $this->Version);
        if(isset($this->MethodParameters)){
            $parameters = $method->addChild("Parameters");
            foreach ($this->MethodParameters as $parameter){
                $parameter = $parameters->addChild("Parameter");

            }
        }
    }


    /**
     * @var $MethodName string
     */
    public $MethodName;


    /**
     * @var $MethodParameters array
     */
    public $MethodParameters;


    /**
     * @var $Version string
     */
    public $Version;
}