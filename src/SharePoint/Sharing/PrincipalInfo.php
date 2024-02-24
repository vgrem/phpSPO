<?php

/**
 * Generated  2024-02-24T10:21:51+00:00 16.0.24607.12008
 */
namespace Office365\SharePoint\Sharing;

use Office365\Runtime\ClientValue;
/**
 * SP.Sharing.PrincipalInfo 
 * class represents Principal and its Role on the list item.
 */
class PrincipalInfo extends ClientValue
{
    /**
     * The 
     * Principal who has permission on the list item.
     * @var Principal
     */
    public $principal;
    /**
     * The role 
     * that the Principal has on the list item.
     * @var integer
     */
    public $role;
    /**
     * @var bool
     */
    public $isInherited;
}