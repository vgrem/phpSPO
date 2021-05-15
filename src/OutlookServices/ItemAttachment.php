<?php

/**
 * Modified: 2020-05-26T22:07:25+00:00 
 */
namespace Office365\OutlookServices;

use Office365\Runtime\ResourcePath;
/**
 *  "A contact, event, or message that's attached to another event, message, or post.  "
 */
class ItemAttachment extends Attachment
{
    /**
     * The attached message or event. Navigation property.
     * @return OutlookItem
     */
    public function getItem()
    {
        return $this->getProperty("Item",
            new OutlookItem($this->getContext(), new ResourcePath("Item", $this->getResourcePath())));
    }

    /**
     * The attached message or event. Navigation property.
     * @param OutlookItem $value
     * @return self
     */
    public function setItem($value)
    {
        $this->setProperty("Item", $value);
        return $this;
    }
}