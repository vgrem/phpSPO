<?php

/**
 * Updated By PHP Office365 Generator 2020-04-22T21:18:30+00:00 16.0.20008.12009
 */
namespace Office365\SharePoint;

use Office365\Runtime\ClientValueObject;
/**
 * Microsoft.SharePoint.Client.MoveCopyOptions 
 * is not applicable.<266>
 */
class MoveCopyOptions extends ClientValueObject
{
    /**
     * @var bool
     */
    public $KeepBoth;
    /**
     * @var bool
     */
    public $ResetAuthorAndCreatedOnCopy;
    /**
     * @var bool
     */
    public $ShouldBypassSharedLocks;
    /**
     * @var bool
     */
    public $RetainEditorAndModifiedOnMove;
}