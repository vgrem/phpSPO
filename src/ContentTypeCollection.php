<?php


namespace SharePoint\PHP\Client;


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
     * @param ContentTypeCreationInformation $parameters
     * @return ContentType
     */
    public function add(ContentTypeCreationInformation $parameters)
    {
        $contentType = new ContentType(
            $this->getContext(),
            $this->getResourcePath()
        );
        $qry = new ClientActionCreateEntity($contentType->getResourceUrl(),$parameters->toJson());
        $this->getContext()->addQuery($qry,$contentType);
        $this->addChild($contentType);
        return $contentType;
    }
}