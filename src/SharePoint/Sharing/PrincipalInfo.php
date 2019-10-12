<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T20:10:10+00:00 16.0.19402.12016
 */
namespace Office365\PHP\Client\SharePoint\Sharing;

use Office365\PHP\Client\Runtime\ClientValueObject;
/**
 * SP.Sharing.PrincipalInfo 
 * class represents Principal and its Role on the list item.
 */
class PrincipalInfo extends ClientValueObject
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
