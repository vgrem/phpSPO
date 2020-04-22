<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T19:39:07+00:00 16.0.19402.12016
 */
namespace Office365\SharePoint\Directory\Provider;

use Office365\Runtime\ClientValueObject;

class RelationData extends ClientValueObject
{
    /**
     * @var integer
     */
    public $AttributeDataSource;
    /**
     * @var string
     */
    public $TargetObjectId;
    /**
     * @var integer
     */
    public $TargetObjectSubtype;
    /**
     * @var integer
     */
    public $TargetObjectType;
    /**
     * @var string
     */
    public $Value;
}