<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T18:54:53+00:00 16.0.19402.12016
 */
namespace Office365\PHP\Client\SharePoint;

use Office365\PHP\Client\Runtime\ClientValueObject;
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
}