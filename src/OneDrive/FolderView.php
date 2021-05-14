<?php

/**
 * Modified: 2020-05-24T22:10:26+00:00 
 */
namespace Office365\OneDrive;

use Office365\Runtime\ClientValue;
class FolderView extends ClientValue
{
    /**
     * @var string
     */
    public $SortBy;
    /**
     * @var string
     */
    public $SortOrder;
    /**
     * @var string
     */
    public $ViewType;
}