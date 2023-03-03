<?php

/**
 * Generated  2023-01-13T18:22:53+02:00 16.0.23207.12005
 */
namespace Office365\SharePoint\Taxonomy\ContentTypeSync;

use Office365\Runtime\ClientValue;
class ContentTypeSyndicationResult extends ClientValue
{
    /**
     * @var array
     */
    public $FailedContentTypeErrors;
    /**
     * @var array
     */
    public $FailedContentTypeIDs;
    /**
     * @var integer
     */
    public $FailedReason;
    /**
     * @var bool
     */
    public $IsPassed;
}