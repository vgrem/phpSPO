<?php

/**
 * Modified: 2019-10-12T20:10:10+00:00  API: 16.0.19402.12016
 */
namespace Office365\SharePoint\Sharing;

use Office365\Runtime\ClientValue;
/**
 * This class 
 * provides details of users who have access to the default document 
 * library. It also indicates whether there are any unique role 
 * assignments for the default document library.
 */
class OversharedWebInfo extends ClientValue
{
    /**
     * Boolean 
     * value that specifies whether default document library 
     * list has unique role assignments.
     * @var bool
     */
    public $hasUniqueRoleAssignmentsForList;
    /**
     * Read/WriteUsers/groups 
     * who have access to the default document library of 
     * another user.
     * @var array
     */
    public $principals;
}