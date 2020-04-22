<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T19:01:57+00:00 16.0.19402.12016
 */
namespace Office365\SharePoint;

use Office365\Runtime\ClientValueObject;
/**
 * Specifies 
 * the parameters that are used to retrieve filter data.
 */
class RenderListFilterDataParameters extends ClientValueObject
{
    /**
     * This 
     * parameter indicates whether field specific list filter html is excluded from 
     * rendering.
     * @var bool
     */
    public $ExcludeFieldFilteringHtml;
    /**
     * The field 
     * internal name whose filter data is returned.
     * @var string
     */
    public $FieldInternalName;
    /**
     * The 
     * overrideScope for which the field filter data is returned. The string values 
     * come from SPView.ConvertStringToViewScope.
     * @var string
     */
    public $OverrideScope;
    /**
     * The 
     * processQString for which the field filter data is returned.
     * @var string
     */
    public $ProcessQStringToCAML;
    /**
     * The View 
     * ID (GUID) for the view from which to retrieve filter data.
     * @var string
     */
    public $ViewId;
}