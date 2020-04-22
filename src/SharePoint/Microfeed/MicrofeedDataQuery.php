<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T19:39:07+00:00 16.0.19402.12016
 */
namespace Office365\SharePoint\Microfeed;

use Office365\Runtime\ClientValueObject;

class MicrofeedDataQuery extends ClientValueObject
{
    /**
     * @var integer
     */
    public $ItemLimit;
    /**
     * @var string
     */
    public $Query;
    /**
     * @var array
     */
    public $ViewFields;
    /**
     * @var bool
     */
    public $ViewFieldsOnly;
}