<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T18:54:53+00:00 16.0.19402.12016
 */
namespace Office365\SharePoint;

use Office365\Runtime\ClientValueObject;
/**
 * Specifies 
 * the properties of a list itemfield (2) 
 * and its value.
 */
class ListItemFormUpdateValue extends ClientValueObject
{
    /**
     * Specifies 
     * the error message result after validating the value for the field (2).
     * @var string
     */
    public $ErrorMessage;
    /**
     * Specifies 
     * the field 
     * internal name for a field (2).
     * @var string
     */
    public $FieldName;
    /**
     * Specifies 
     * a value for a field (2).
     * @var string
     */
    public $FieldValue;
    /**
     * Specifies 
     * whether there was an error result after validating the value for the field (2).
     * @var bool
     */
    public $HasException;
    /**
     * @var integer
     */
    public $ItemId;
}