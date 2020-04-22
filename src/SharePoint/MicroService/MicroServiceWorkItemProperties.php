<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T19:45:14+00:00 16.0.19402.12016
 */
namespace Office365\SharePoint\MicroService;

use Office365\Runtime\ClientValueObject;

class MicroServiceWorkItemProperties extends ClientValueObject
{
    /**
     * @var string
     */
    public $ApiPath;
    /**
     * @var array
     */
    public $CustomProperties;
    /**
     * @var array
     */
    public $HttpHeaders;
    /**
     * @var string
     */
    public $MicroServiceName;
    /**
     * @var integer
     */
    public $RequestType;
}