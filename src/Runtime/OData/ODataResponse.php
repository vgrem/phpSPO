<?php


namespace Office365\PHP\Client\Runtime\OData;


use Exception;
use Office365\PHP\Client\Runtime\ClientResponse;
use Office365\PHP\Client\Runtime\ClientResult;
use Office365\PHP\Client\Runtime\IEntityType;
use Office365\PHP\Client\Runtime\IEntityTypeCollection;
use Office365\PHP\Client\SharePoint\ChangeLogItemQuery;


class ODataResponse extends ClientResponse
{

    /**
     * @return bool
     * @throws Exception
     */
    public function validate()
    {
        if ($this->StatusCode >= 400) {
            $this->extractError($error,$this->Content);
            throw new Exception($error['Message']);
        }
        return true;
    }

    /**
     * Process Xml response from SharePoint REST service
     * @param $payload string
     * @return array
     */
    protected function transformXml($payload)
    {
        $json = array();
        $xml = simplexml_load_string($payload);
        $xml->registerXPathNamespace('z', '#RowsetSchema');
        $rows = $xml->xpath("//z:row");
        foreach ($rows as $row) {
            $item = null;
            foreach ($row->attributes() as $k => $v) {
                $normalizedFieldName = str_replace('ows_', '', $k);
                $item[$normalizedFieldName] = (string)$v;
            }
            $json[] = $item;
        }
        return $json;
    }


    /**
     * @param IEntityType|ClientResult $targetObject
     * @param ODataFormat $format
     */
    public function map($targetObject, $format)
    {
        $json = json_decode($this->Content, true);
        if ($format instanceof JsonLightFormat) {
            if (isset($json[$format->getSecurityProperty()]))
                $json = $json[$format->getSecurityProperty()];
            if (isset($json[$format->getFunctionProperty()]))
                $json = $json[$format->getFunctionProperty()];
        }

        if ($targetObject instanceof ClientResult) {
            if ($targetObject->getValue() instanceof IEntityType) {
                $this->mapType($json, $targetObject->getValue(),$format);
            }
            else {
                $targetObject->setValue($json);
            }
        } else {
            if ($targetObject instanceof ChangeLogItemQuery) {
                $json = $this->transformXml($this->Content);
            }
            $this->mapType($json, $targetObject,$format);
        }
    }

    /**
     * Maps response payload to client object
     * @param $json array
     * @param $object IEntityType
     * @param $format ODataFormat
     */
    protected function mapType($json, $object, $format)
    {
        if ($object instanceof IEntityTypeCollection) {
            $this->mapCollection($json, $object, $format);
        } else {
            foreach ($json as $key => $value) {
                if ($key !== $format->getProperty('metadata')
                    && fnmatch($format->getProperty('control'), $key) !== true) {
                    if (is_array($value) && !empty($value)) {
                        $property = $object->getProperty($key);
                        if ($property instanceof IEntityType) {
                            if(isset($value[$format->getProperty('deferred')]))
                                $object->setProperty($key, null, false);
                            else
                                $this->mapType($value, $property, $format);
                        }
                        else {
                            $result = null;
                            $this->normalizeProperty($value, $result, $format);
                            $object->setProperty($key, $result, false);
                        }
                    } else
                        $object->setProperty($key, $value, false);
                }
            }
        }
    }

    private function normalizeProperty($json,&$result, ODataFormat $format)
    {
        foreach ($json as $key => $value) {
            if ($key !== $format->getProperty('metadata')
                and fnmatch($format->getProperty('control'), $key) !== true
                and $key !== $format->getProperty('deferred')) {

                if (is_array($value)) {
                    if ($key === $format->getProperty('collection')) {
                        $json = $json[$format->getProperty('collection')];
                        $this->normalizeProperty($json, $result, $format);
                    }
                    else
                        $this->normalizeProperty($value, $result[$key], $format);
                } else {
                    $result[$key] = $value;
                }
            }
        }
    }

    private function mapCollection($json, IEntityTypeCollection $object,ODataFormat $format){
        $json = $json[$format->getProperty('collection')];
        $object->clearData();
        foreach ($json as $item) {
            $type = $object->createType();
            $this->mapType($item, $type,$format);
            $object->addChild($type);
        }
    }



    /**
     * Extract error from JSON payload response
     * @param $error array
     * @param $payload string
     */
    private function extractError(&$error, $payload=null)
    {
        $json = is_string($payload) ? json_decode($payload) : $payload;
        if(is_null($json)){
            $error = ['Message' => $payload];
            return;
        }
        foreach ($json as $key=> $value){
            if(is_object($value)){
                $this->extractError($error,$value);
            }
            elseif($key === "message" || $key === "value")
                $error = ['Message' => $value];
        }
        if(!$error)
            $error = ['Message' => "Unknown error"];
    }
}
