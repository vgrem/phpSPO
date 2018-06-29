<?php


namespace Office365\PHP\Client\Runtime;
use Office365\PHP\Client\Runtime\CSOM\ICSOMCallable;
use SimpleXMLElement;

/**
 * Resource path to address Service Operations which represents simple functions exposed by an OData service
 */
class ResourcePathServiceOperation extends ResourcePath implements ICSOMCallable
{
    /**
     * ResourcePathMethod constructor.
     * @param ClientRuntimeContext $context
     * @param ResourcePath|null $parent
     * @param string $methodName
     * @param array $methodParameters
     */
    public function __construct(ClientRuntimeContext $context, ResourcePath $parent=null, $methodName, $methodParameters = null)
    {
        parent::__construct($context, $parent);
        $this->methodName = $methodName;
        $this->methodParameters = $methodParameters;
    }


    public function toString()
    {
        $url = isset($this->methodName) ? $this->methodName : "";
        if (!isset($this->methodParameters))
            return $url;

        if (count(array_filter(array_keys($this->methodParameters), 'is_string')) === 0) {
            $url = $url . "(" . implode(',', array_map(
                        function ($value) {
                            $encValue = self::escapeValue($value);
                            return "$encValue";
                        }, $this->methodParameters)
                ) . ")";
        } else {
            $url = $url . "(" . implode(',', array_map(
                        function ($key, $value) {
                            $encValue = self::escapeValue($value);
                            return "$key=$encValue";
                        }, array_keys($this->methodParameters), $this->methodParameters)
                ) . ")";
        }
        return $url;
    }

    private static function escapeValue($value)
    {
        if (is_string($value))
            $value = "'" . $value . "'";
        elseif (is_bool($value))
            $value = var_export($value, true);
        return $value;
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