<?php


namespace Office365\Runtime\Paths;
use Exception;
use Office365\Runtime\ClientObject;
use Office365\Runtime\ClientValue;
use Office365\Runtime\CSOM\ICSOMCallable;
use Office365\Runtime\ResourcePath;
use SimpleXMLElement;

/**
 * Resource path to address Service Operations which represents simple functions exposed by an OData service
 */
class ServiceOperationPath extends ResourcePath implements ICSOMCallable
{
    /**
     * ResourcePathMethod constructor.
     * @param string $methodName
     * @param array|ClientObject|ClientValue $methodParameters
     * @param ResourcePath|null $parent
     */
    public function __construct($methodName=null, $methodParameters = null, ?ResourcePath $parent=null)
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
        if (is_string($value)) {
            /**
             * Given value that is a path, like `/sites/Site/O'Reilly`, needs to be enclosed within quotes:
             * ```
             * GET https://{site_url}/_api/web/GetFolderByServerRelativeUrl('/sites/Site/O'Reilly')/Files
             * ```
             * because the quote within the name of the folder `O'Reilly` is messing up where the argument ends,
             * it needs to be escaped, like so:
             * ```
             * GET https://{site_url}/_api/web/GetFolderByServerRelativeUrl('/sites/Site/O''Reilly')/Files
             * ```
             * before sending it to the API.
             *
             *
             * `rawurlencode`ing it doesn't solve the issue, the URL is decoded before it is evaluated by the API it seems.
             *
             *
             * Sources:
             * - https://sharepoint.stackexchange.com/questions/154590/getfilebyserverrelativeurl-fails-when-the-filename-contains-a-quote
             * - https://web.archive.org/web/20230325070719/http://www.sharepointnadeem.com/2012/06/special-characters-in-rest-query-filter.html
             */
            $value = str_replace('%27', '%27%27', $value);
            $value = str_replace("'", "''", $value);
            $value = "'" . $value . "'";
        } elseif (is_bool($value)) {
            $value = var_export($value, true);
        }
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
