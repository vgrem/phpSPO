<?php

/**
 * Modified: 2020-05-25T06:42:59+00:00 
 */
namespace Office365\OneDrive;

use Office365\Runtime\ClientValue;
class Folder extends ClientValue
{
    /**
     * @var integer
     */
    public $ChildCount;
    /**
     * @var FolderView
     */
    public $View;
}