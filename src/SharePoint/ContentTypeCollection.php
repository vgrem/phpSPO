<?php


namespace Office365\SharePoint;

use Office365\Runtime\Actions\InvokePostMethodQuery;
use Office365\Runtime\ClientObject;
use Office365\Runtime\ClientRuntimeContext;
use Office365\Runtime\ResourcePath;
use Office365\Runtime\ResourcePathServiceOperation;

class ContentTypeCollection extends BaseEntityCollection
{

    /**
     * @param ClientRuntimeContext $ctx
     * @param ResourcePath|null $resourcePath
     * @param ClientObject|null $parent
     */
    public function __construct(ClientRuntimeContext $ctx, ResourcePath $resourcePath = null, ClientObject $parent = null)
    {
        parent::__construct($ctx, $resourcePath, ContentType::class, $parent);
    }

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
        $this->addChild($contentType);
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