<?php

/**
 * Modified: 2020-05-26T22:12:31+00:00 
 */
namespace Office365\OneDrive;

use Office365\Common\InsightIdentity;
use Office365\Runtime\ClientValue;
class SharingDetail extends ClientValue
{
    /**
     * @var string
     */
    public $SharingSubject;
    /**
     * @var string
     */
    public $SharingType;
    /**
     * @var InsightIdentity
     */
    public $SharedBy;
    /**
     * @var ResourceReference
     */
    public $SharingReference;
}