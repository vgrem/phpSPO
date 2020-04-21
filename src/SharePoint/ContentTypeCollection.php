<?php


namespace Office365\PHP\Client\SharePoint;

use Office365\PHP\Client\Runtime\ClientObjectCollection;
use Office365\PHP\Client\Runtime\InvokePostMethodQuery;
use Office365\PHP\Client\Runtime\ResourcePathServiceOperation;

class ContentTypeCollection extends ClientObjectCollection
{

    /**
     * @param string $id
     * @return ContentType
     */
    public function getById($id)
    {
        $contentType = new ContentType(
            $this->getContext(),
            new ResourcePathServiceOperation("GetById",array($id),$this->getResourcePath())
        );
        $contentType->parentCollection = $this;
        return $contentType;
    }


    /**
     * Creates a ContentType resource
     * @param ContentTypeCreationInformation $information
     * @return ContentType
     */
    public function add(ContentTypeCreationInformation $information)
    {
        $contentType = new ContentType($this->getContext());
        $qry = new InvokePostMethodQuery($this,null,null,null,$information);
        $this->getContext()->addQueryAndResultObject($qry,$contentType);
        $this->addChild($contentType);
        return $contentType;
    }
}