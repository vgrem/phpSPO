<?php

/**
 * Generated  2023-01-13T18:22:53+02:00 16.0.23207.12005
 */
namespace Office365\SharePoint;

use Office365\Runtime\ClientValue;
class GetListItemVersionsParameters extends ClientValue
{
    /**
     * @var integer
     */
    public $RowLimit;
    /**
     * @var bool
     */
    public $SortDescending;
    /**
     * @var ListItemVersionCollectionPosition
     */
    public $ListItemVersionCollectionPosition;
}