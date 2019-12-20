<?php


namespace Office365\PHP\Client\OneNote;


use Office365\PHP\Client\Runtime\ClientObject;
use Office365\PHP\Client\Runtime\ResourcePathEntity;

class OneNote extends ClientObject
{

    /**
     * @return PageCollection
     */
    public function getPages()
    {
        if (!$this->isPropertyAvailable("Pages")) {
            $this->setProperty("Pages",
                new PageCollection($this->getContext(), new ResourcePathEntity(
                    $this->getContext(),
                    $this->getResourcePath(),
                    "Pages"
                )));
        }
        return $this->getProperty("Pages");
    }


}
