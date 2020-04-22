<?php


namespace Office365\OutlookServices;


/**
 * A message, contact, or event that's attached to another message or event
 */
class ItemAttachment extends Attachment
{

    /**
     * The attached message or event. Navigation property.
     * @var Item
     */
    public $Item;

}