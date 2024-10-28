<?php

/**
 * Generated  2024-10-28T19:35:46+00:00 16.0.25409.12005
 */
namespace Office365\SharePoint\Publishing;

use Office365\Runtime\ClientValue;
class CopyToParams extends ClientValue
{
    /**
     * @var bool
     */
    public $AsNews;
    /**
     * @var bool
     */
    public $AsTemplate;
    /**
     * @var bool
     */
    public $CanvasContentOnly;
    /**
     * @var string
     */
    public $ComponentJSONString;
    /**
     * @var bool
     */
    public $CreateCopyForEdit;
    /**
     * @var bool
     */
    public $CreateIfMissing;
    /**
     * @var string
     */
    public $DestinationPageUniqueId;
    /**
     * @var integer
     */
    public $DestinationType;
    /**
     * @var string
     */
    public $DestinationWebUrl;
    /**
     * @var string
     */
    public $SitePageFlags;
    /**
     * @var bool
     */
    public $AsPrivateAuthoringPage;
    /**
     * @var bool
     */
    public $DeleteSourcePage;
    /**
     * @var integer
     */
    public $ScenarioID;
    /**
     * @var string
     */
    public $ScenarioPayload;
    /**
     * @var bool
     */
    public $CreateCopyWithTitleSuffix;
    /**
     * @var array
     */
    public $DependencyPropertyTypesToDeepCopy;
}