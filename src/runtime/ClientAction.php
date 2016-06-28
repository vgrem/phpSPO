<?php

namespace SharePoint\PHP\Client;


/**
 * OData query
 */
class ClientAction
{
    /**
     * @var int
     */
    private $methodType;

    /**
     * @var string
     */
    private $resourceUrl;

    /**
     * @var string
     */
    private $data;
    

    /**
     * @var bool
     */
    private $binaryStringRequestBody;

    /**
     * @var int
     */
    private $dataFormatType;


    /**
     * ClientAction constructor.
     * @param string $resourceUrl
     * @param string $data
     * @param int $methodType
     */
    public function __construct($resourceUrl, $data=null, $methodType=null)
    {
        $this->resourceUrl = $resourceUrl;
        $this->data = $data;
        $this->methodType = $methodType;
        $this->binaryStringRequestBody = false;
        $this->dataFormatType = FormatType::Json;
    }


    /**
     * @return int
     */
    public function getDataFormatType(){
        return $this->dataFormatType;
    }

    /**
     * @return string
     */
    public function getId(){
        return spl_object_hash($this);
    }


    /**
     * @return string
     */
    public function getResourceUrl(){
        return $this->resourceUrl;
    }


    public function getData(){
        return $this->data;
    }


    /**
     * @return int
     */
    public function getMethodType()
    {
        return $this->methodType;
    }

    /**
     * @param bool $value
     */
    public function setBinaryStringRequestBody($value)
    {
        $this->binaryStringRequestBody = $value;
    }

    /**
     * @param int $value
     */
    public function setDataFormatType($value)
    {
        $this->dataFormatType = $value;
    }
}

