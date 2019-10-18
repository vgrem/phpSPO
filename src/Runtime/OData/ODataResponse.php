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
    public function validate(){
        if ($this->StatusCode >= 400) {
            $this->extractError($error);
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
     * Maps response payload to client object
     * @param $json array
     * @param $object IEntityType
     */
    protected function mapJson($json,IEntityType $object)
    {
        if($object instanceof IEntityTypeCollection){
            $object->clearData();
            foreach ($json as $item) {
                $type = $object->createType();
                $this->mapJson($item, $type);
                $object->addChild($type);
            }
        }
        else if(is_array($json)){
            foreach ($json as $key => $value) {
                if (is_array($value)) {
                    $property = $object->getProperty($key);
                    if ($property instanceof IEntityType) {
                        $this->mapJson($value,$property);
                    } else {
                        $object->setProperty($key, $value, false);
                    }
                } else {
                    $object->setProperty($key, $value, false);
                }
            }
        }
    }


    /**
     * @param IEntityType|ClientResult $targetObject
     * @param ODataFormat $format
     */
    public function map($targetObject, $format)
    {
        $json = json_decode($this->Payload, true);
        $this->normalizePayload($json, $format);
        //if(empty($json)){
        //}


        if ($targetObject instanceof ClientResult) {
            if ($targetObject->getValue() instanceof IEntityType)
                $this->mapJson($json, $targetObject->getValue());
            else
                $targetObject->setValue($json);
        } else {
            if ($targetObject instanceof ChangeLogItemQuery) {
                $json = $this->transformXml($this->Payload);
            }
            $this->mapJson($json, $targetObject);
        }

    }

    private function normalizePayload(&$json, ODataFormat $format){
        if(!is_array($json))
            return;
        foreach ($json as $key=>$value) {
            if (in_array((string)$key, $format->Annotations)) {
                $json = $json[$key];
                $this->normalizePayload($json, $format);
            } elseif (is_array($value)){
                if(array_key_exists($key, $format->Annotations) || substr($key, 0, 7) === "@odata."){
                    unset($json[$key]);
                    if(empty($json))
                        $json = null;
                }
                else
                    $this->normalizePayload($json[$key], $format);
            }
        }
    }


    /**
     * Extract error from JSON payload response
     * @param $error array
     * @param $json array
     */
    private function extractError(&$error,$json=null)
    {
        $json = $json === null ? json_decode($this->Payload) : $json;
        foreach ($json as $key=>$value){
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
