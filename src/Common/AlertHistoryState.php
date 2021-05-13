<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientValue;
class AlertHistoryState extends ClientValue
{
    /**
     * @var string
     */
    public $AppId;
    /**
     * @var string
     */
    public $AssignedTo;
    /**
     * @var array
     */
    public $Comments;
    /**
     * @var string
     */
    public $User;
}