<?php

/**
 * Updated By PHP Office365 Generator 2019-11-17T14:59:21+00:00 16.0.19506.12022
 */
namespace Office365\SharePoint;

use Office365\Runtime\ClientValueObject;
/**
 * This 
 * indicates an object encapsulating various options to use while saving a file.
 */
class FileCollectionAddParameters extends ClientValueObject
{
    /**
     * @var bool
     */
    public $AutoCheckoutOnInvalidData;
    /**
     * Specifies 
     * whether to overwrite an existing file of the same name as the one being 
     * created.
     * @var bool
     */
    public $Overwrite;
    /**
     * @var string
     */
    public $XorHash;
}