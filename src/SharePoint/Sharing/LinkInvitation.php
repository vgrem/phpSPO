<?php

/**
 * Modified: 2019-10-12T20:07:53+00:00  API: 16.0.19402.12016
 */
namespace Office365\SharePoint\Sharing;

use Office365\Runtime\ClientValue;
/**
 * This class 
 * is used to identify the specific invitees for a tokenized sharing link, 
 * along with who invited them and when.
 */
class LinkInvitation extends ClientValue
{
    /**
     * Indicates 
     * the principal who invited the invitee to the tokenized sharing link. 
     * 
     * @var Principal
     */
    public $invitedBy;
    /**
     * String 
     * representation of nullable DateTime value indicating when the invitee was 
     * invited to the tokenized sharing link. 
     * 
     * @var string
     */
    public $invitedOn;
    /**
     * Indicates 
     * a principal who is invited to the tokenized sharing link. 
     * 
     * @var Principal
     */
    public $invitee;
}
