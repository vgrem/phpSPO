<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientValue;
class SecureScoreControlStateUpdate extends ClientValue
{
    /**
     * @var string
     */
    public $AssignedTo;
    /**
     * @var string
     */
    public $Comment;
    /**
     * @var string
     */
    public $State;
    /**
     * @var string
     */
    public $UpdatedBy;
}