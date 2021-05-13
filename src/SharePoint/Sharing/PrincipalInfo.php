<?php

/**
 * Modified: 2019-10-12T20:10:10+00:00  API: 16.0.19402.12016
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
}
