<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T18:45:59+00:00 16.0.19402.12016
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
}