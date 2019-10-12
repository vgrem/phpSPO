<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T20:10:10+00:00 16.0.19402.12016
 */
namespace Office365\PHP\Client\SharePoint\Sharing;

use Office365\PHP\Client\Runtime\ClientValueObject;
/**
 * This class 
 * represents an Entity for which Permission check is requested for a given list item.
 */
class Recipient extends ClientValueObject
{
    /**
     * The alias 
     * of the recipient.
     * @var string
     */
    public $alias;
    /**
     * The email 
     * address of the recipient.
     * @var string
     */
    public $email;
    /**
     * The 
     * objectId of the recipient.
     * @var string
     */
    public $objectId;
}