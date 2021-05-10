<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\Teams;

use Office365\Runtime\ClientValue;
class TeamsTabConfiguration extends ClientValue
{
    /**
     * @var string
     */
    public $EntityId;
    /**
     * @var string
     */
    public $ContentUrl;
    /**
     * @var string
     */
    public $RemoveUrl;
    /**
     * @var string
     */
    public $WebsiteUrl;
}