<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T19:34:55+00:00 16.0.19402.12016
 */
namespace Office365\PHP\Client\SharePoint\MetadataNavigation;

use Office365\PHP\Client\Runtime\ClientValueObject;

class ConfiguredMetadataNavigationItem extends ClientValueObject
{
    /**
     * @var string
     */
    public $FieldDisplayName;
    /**
     * @var string
     */
    public $FieldTitle;
    /**
     * @var string
     */
    public $FieldTypeAsString;
    /**
     * @var bool
     */
    public $IsContentTypeField;
    /**
     * @var bool
     */
    public $IsFolderHierarchy;
    /**
     * @var bool
     */
    public $IsHierarchy;
    /**
     * @var bool
     */
    public $IsMultiValueLookup;
    /**
     * @var bool
     */
    public $IsTaxonomyField;
}