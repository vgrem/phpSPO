<?php

/**
 * Modified: 2019-10-12T20:10:10+00:00  API: 16.0.19402.12016
 */
namespace Office365\SharePoint\Sharing;

use Office365\Runtime\ClientValue;
/**
 * An object 
 * that contains the result of calling the API to remove an item from a user's 
 * 'Shared With Me' view.
 */
class SharedWithMeViewItemRemovalResult extends ClientValue
{
    /**
     * Error code 
     * if the operation was not successful.
     * @var integer
     */
    public $ErrorCode;
    /**
     * Description 
     * of the error that happened if the operation was not successful.
     * @var string
     */
    public $ErrorMessage;
    /**
     * Indicates 
     * whether the overall operation succeeded.
     * @var bool
     */
    public $Success;
}