<?php

/**
 * Modified: 2020-05-24T22:08:35+00:00
 */
namespace Office365\OutlookServices;

use Exception;
use Office365\Entity;
use Office365\Runtime\Actions\InvokeMethodQuery;

/**
 *  "A profile photo of a user, group or an Outlook contact accessed from Exchange Online. It's binary data not encoded in base-64."
 */
class ProfilePhoto extends Entity
{

    /**
     * Download a photo content
     * @param resource $handle
     * @throws Exception
     */
    public function getContent($handle)
    {
        $qry = new InvokeMethodQuery($this,"\$value");
        $this->getContext()->addQuery($qry);
        $this->getContext()->getPendingRequest()->beforeExecuteRequestOnce(function ($request) use ($handle){
            $request->StreamHandle = $handle;
        });
        return $this;
    }


    /**
     * The height of the photo. Read-only.
     * @return integer
     */
    public function getHeight()
    {
        return $this->getProperty("Height");
    }

    /**
     * The height of the photo. Read-only.
     *
     * @return self
     * @var integer
     */
    public function setHeight($value)
    {
        return $this->setProperty("Height", $value, true);
    }
    /**
     * The width of the photo. Read-only.
     * @return integer
     */
    public function getWidth()
    {
        return $this->getProperty("Width");
    }

    /**
     * The width of the photo. Read-only.
     *
     * @return self
     * @var integer
     */
    public function setWidth($value)
    {
        return $this->setProperty("Width", $value, true);
    }
}