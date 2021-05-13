<?php

/**
 * Modified: 2020-08-05T10:16:13+00:00 16.0.20315.12009
 */
namespace Office365\SharePoint\Sharing;

use Office365\Runtime\ClientValue;
use Office365\SharePoint\SharingLinkInfo;
class SharingLinkDefaultTemplate extends ClientValue
{
    /**
     * @var SharingLinkInfo
     */
    public $linkDetails;
    /**
     * @var bool
     */
    public $passwordProtected;
    /**
     * @var integer
     */
    public $role;
    /**
     * @var integer
     */
    public $scope;
    /**
     * @var integer
     */
    public $shareKind;
    /**
     * @var bool
     */
    public $trackLinkUsers;
}