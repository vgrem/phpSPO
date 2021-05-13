<?php

/**
 * Modified: 2019-10-12T20:10:10+00:00  API: 16.0.19402.12016
 */
namespace Office365\SharePoint\Sharing;

use Office365\Runtime\ClientValue;
/**
 * Specifies 
 * a sharing result for an individual user that method UpdateDocumentSharingInfo 
 * (section 3.2.5.187.2.1.1) 
 * returns.<195>
 */
class UserSharingResult extends ClientValue
{
    /**
     * Read OnlySpecifies a set of roles 
     * that can be assigned to the user.
     * @var array
     */
    public $AllowedRoles;
    /**
     * Specifies the role 
     * that the user is currently assigned to.
     * @var integer
     */
    public $CurrentRole;
    /**
     * Gets the 
     * display name of the user.
     * @var string
     */
    public $DisplayName;
    /**
     * Gets the 
     * user email.
     * @var string
     */
    public $Email;
    /**
     * Gets the 
     * invitation link.
     * @var string
     */
    public $InvitationLink;
    /**
     * Specifies 
     * whether the user is known to the server. If "true", the user is known 
     * to the server; if "false", user is unknown.
     * @var bool
     */
    public $IsUserKnown;
    /**
     * Specifies 
     * a message string that explains the reason when the Status (section 3.2.5.190.1.1.4) 
     * property is "false".
     * @var string
     */
    public $Message;
    /**
     * Specifies 
     * whether the sharing update for the user was completed successfully. If 
     * "true", the sharing update completed successfully for the user; if 
     * "false", the sharing update failed for the user.
     * @var bool
     */
    public $Status;
    /**
     * Specifies 
     * a sharing result for an individual user that method UpdateDocumentSharingInfo 
     * (section 3.2.5.187.2.1.1) 
     * returns.<195>
     * @var string
     */
    public $User;
}