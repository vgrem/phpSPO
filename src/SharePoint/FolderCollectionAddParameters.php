<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T18:54:53+00:00 16.0.19402.12016
 */
namespace Office365\SharePoint;

use Office365\Runtime\ClientValueObject;
/**
 * Specifies 
 * the settings used for creating a folder.
 */
class FolderCollectionAddParameters extends ClientValueObject
{
    /**
     * Specifies 
     * whether to overwrite an existing folder of the same name as the one being 
     * created.
     * @var bool
     */
    public $Overwrite;
}