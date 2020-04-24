<?php

/**
 * Updated By PHP Office365 Generator 2020-04-22T21:18:30+00:00 16.0.20008.12009
 */
namespace Office365\SharePoint;

use Office365\Runtime\ClientValueObject;
class ClassificationResult extends ClientValueObject
{
    /**
     * @var double
     */
    public $ConfidenceScore;
    /**
     * @var string
     */
    public $ContentTypeId;
    /**
     * @var array
     */
    public $Metas;
    /**
     * @var string
     */
    public $ModelId;
    /**
     * @var string
     */
    public $ModelVersion;
    /**
     * @var integer
     */
    public $RetryCount;
}