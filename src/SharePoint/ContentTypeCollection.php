<?php


namespace Office365\PHP\Client\SharePoint;


use Office365\PHP\Client\Runtime\ClientActionCreateEntity;
use Office365\PHP\Client\Runtime\ClientObjectCollection;
use Office365\PHP\Client\Runtime\OData\ODataPayload;
use Office365\PHP\Client\Runtime\ResourcePathServiceOperation;

class ContentTypeCollection extends ClientObjectCollection
{

    /**
     * @param string $id
     * @return ContentType
     */
    public function getById($id)
    {
        return new ContentType(
            $this->getContext(),
            new ResourcePathServiceOperation($this->getContext(),$this->getResourcePath(),"GetById",array($id))
        );
    }


    /**
     * Creates a ContentType resource
     * @param ContentTypeCreationInformation $information
     * @return ContentType
     */
    public function add(ContentTypeCreationInformation $information)
    {
        $contentType = new ContentType($this->getContext(),$this->getResourcePath());
        $qry = new ClientActionCreateEntity($this,ODataPayload::createFromObject($information));
        $this->getContext()->addQuery($qry,$contentType);
        $this->addChild($contentType);
        return $contentType;
    }
}