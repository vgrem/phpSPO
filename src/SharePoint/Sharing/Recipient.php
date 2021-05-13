<?php

/**
 * Modified: 2019-10-12T20:10:10+00:00  API: 16.0.19402.12016
 */
namespace Office365\SharePoint\Sharing;

use Office365\Runtime\ClientValue;
/**
 * This class 
 * represents an Entity for which Permission check is requested for a given list item.
 */
class Recipient extends ClientValue
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