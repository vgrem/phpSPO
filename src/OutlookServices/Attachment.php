<?php


namespace Office365\PHP\Client\OutlookServices;

use Office365\PHP\Client\Runtime\ClientObject;

/**
 * A file or item (contact, event or message) attached to an event or message.
 */
class Attachment extends ClientObject
{
    /**
     * The MIME type of the attachment.
     * @var string
     */
    public $ContentType;


    /**
     * true if the attachment is an inline attachment; otherwise, false.
     * @var boolean
     */
    public $IsInline;


    /**
     * The date and time when the attachment was last modified.
     * @var \DateTime
     */
    public $LastModifiedDateTime;


    /**
     * The display name of the attachment. This does not need to be the actual file name.
     * @var string
     */
    public $Name;


    /**
     * The length of the attachment in bytes.
     * @var int
     */
    public $Size;

}