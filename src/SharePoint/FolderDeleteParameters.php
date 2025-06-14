<?php

/**
 * Generated  2025-06-14T08:50:37+00:00 16.0.26121.12017
 */
namespace Office365\SharePoint;

use Office365\Runtime\ClientValue;
class FolderDeleteParameters extends ClientValue
{
    /**
     * @var bool
     */
    public $BypassSharedLock;
    /**
     * @var bool
     */
    public $DeleteIfEmpty;
    /**
     * @var string
     */
    public $ETagMatch;
    /**
     * @var bool
     */
    public $BypassCheckedOut;
}