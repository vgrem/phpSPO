<?php

/**
 * Modified: 2019-10-12T20:10:10+00:00  API: 16.0.19402.12016
 */
namespace Office365\SharePoint\Sharing;

use Office365\Runtime\ClientValue;
/**
 * Represents 
 * a response for 
 * Microsoft.SharePoint.Client.Sharing.SecurableObjectExtensions.CheckPermissions
 */
class EntityPermission extends ClientValue
{
    /**
     * @var bool
     */
    public $canHaveAccess;
    /**
     * @var integer
     */
    public $existingAccessType;
    /**
     * Boolean 
     * indicating whether the Entity has Access to the list item.
     * @var bool
     */
    public $hasAccess;
    /**
     * The Input 
     * Entity string provided to the call.
     * @var string
     */
    public $inputEntity;
    /**
     * @var bool
     */
    public $isPending;
    /**
     * @var integer
     */
    public $recipientDeniedReason;
    /**
     * The 
     * Resolved Entity after resolving using PeoplePicker API.
     * @var string
     */
    public $resolvedEntity;
    /**
     * Role of 
     * the Entity on list item.
     * @var integer
     */
    public $role;
}