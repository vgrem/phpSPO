<?php

/**
 * Modified: 2020-05-24T22:10:26+00:00 
 */
namespace Office365\Excel;

use Office365\Runtime\ClientValue;
class WorkbookSessionInfo extends ClientValue
{
    /**
     * @var string
     */
    public $Id;
    /**
     * @var bool
     */
    public $PersistChanges;
}