<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T19:39:07+00:00 16.0.19402.12016
 */
namespace Office365\PHP\Client\SharePoint\Directory\Provider;

use Office365\PHP\Client\Runtime\ClientValueObject;

class LinkTarget extends ClientValueObject
{
    /**
     * @var string
     */
    public $ObjectId;
    /**
     * @var integer
     */
    public $ObjectSubType;
    /**
     * @var integer
     */
    public $ObjectType;
}