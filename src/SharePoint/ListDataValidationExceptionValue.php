<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T18:54:53+00:00 16.0.19402.12016
 */
namespace Office365\PHP\Client\SharePoint;

use Office365\PHP\Client\Runtime\ClientValueObject;
/**
 * Specifies 
 * failure information for a failed field (2) or list itemdata 
 * validation. 
 */
class ListDataValidationExceptionValue extends ClientValueObject
{
    /**
     * Read OnlySpecifies 
     * the collection of all failures that occurred during field (2)data 
     * validation.
     * @var array
     */
    public $FieldFailures;
    
    public $ItemFailure;
}