<?php


namespace Office365\Runtime;
use Exception;
use Office365\Runtime\CSOM\ICSOMCallable;
use SimpleXMLElement;

/**
 * Resource path to address Service Operations which represents simple functions exposed by an OData service
 */
class ResourcePathServiceOperation extends ResourcePath implements ICSOMCallable
{
    /**
     * ResourcePathMethod constructor.
     * @param string $methodName
     * @param array|ClientObject|ClientValue $methodParameters
     * @param ResourcePath|null $parent
     */
    public function __construct($methodName=null, $methodParameters = null,ResourcePath $parent=null)
    {
        parent::__construct($this->buildSegment($methodName,$methodParameters), $parent);
        $this->methodName = $methodName;
        $this->methodParameters = $methodParameters;
    }


    /**
     * @param string $methodName
     * @param array $methodParameters
     * @return string|null
     */
    private function buildSegment($methodName,$methodParameters)
    {
        $url = isset($methodName) ? $methodName : "";
        if (!isset($methodParameters) || !is_array($methodParameters))
            return $url;

        if (count(array_filter(array_keys($methodParameters), 'is_string')) === 0) {
            $url = $url . "(" . implode(',', array_map(
                        function ($value) {
                            $encValue = self::escapeValue($value);
                            return "$encValue";
                        }, $methodParameters)
                ) . ")";
        } else {
            $url = $url . "(" . implode(',', array_map(
                        function ($key, $value) {
                            $encValue = self::escapeValue($value);
                            return "$key=$encValue";
                        }, array_keys($methodParameters), $methodParameters)
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
        throw new Exception("Not implemented");
    }


    /**
     * @return string|null
     */
    function getMethodName(){
        return $this->methodName;
    }

    /**
     * @return array|ClientObject|ClientValue|null
     */
    function getMethodParameters(){
        return $this->methodParameters;
    }

    /**
     * @var array|ClientObject|ClientValue
     */
    protected $methodParameters;

    /**
     * @var string
     */
    protected $methodName;

}
