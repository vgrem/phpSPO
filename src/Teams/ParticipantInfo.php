<?php

/**
 * Modified: 2020-05-29T07:19:37+00:00
 */
namespace Office365\Teams;

use Office365\Common\IdentitySet;
use Office365\Runtime\ClientValue;
class ParticipantInfo extends ClientValue
{
    /**
     * @var IdentitySet
     */
    public $Identity;
    /**
     * @var string
     */
    public $Region;
    /**
     * @var string
     */
    public $LanguageId;
    /**
     * @var string
     */
    public $CountryCode;
}