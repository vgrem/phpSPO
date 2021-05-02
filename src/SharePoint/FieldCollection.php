<?php
/**
 * Represents a collection of Field resources
 */

namespace Office365\SharePoint;

use Office365\Runtime\Actions\InvokePostMethodQuery;
use Office365\Runtime\ClientObject;
use Office365\Runtime\ClientRuntimeContext;
use Office365\Runtime\ResourcePath;
use Office365\Runtime\ResourcePathServiceOperation;

class FieldCollection extends BaseEntityCollection
{

    public function __construct(ClientRuntimeContext $ctx, ResourcePath $resourcePath = null, ClientObject $parent = null)
    {
        parent::__construct($ctx, $resourcePath, Field::class, $parent);
    }

    /**
     * Creates a Field resource
     * @param FieldCreationInformation $parameters
     * @return Field
     */
    public function add(FieldCreationInformation $parameters)
    {
        $field = new Field($this->getContext());
        $qry = new InvokePostMethodQuery($this,null,null,null,$parameters);
        $this->getContext()->addQueryAndResultObject($qry,$field);
        $this->addChild($field);
        return $field;
    }


    /**
     * @param string $title
     * @return Field
     */
    public function getByTitle($title)
    {
        return new Field(
            $this->getContext(),
            new ResourcePathServiceOperation("getByTitle",array($title),$this->getResourcePath())
        );
    }

    /**
     * @param string $internalNameOrTitle
     * @return Field
     */
    public function getByInternalNameOrTitle($internalNameOrTitle)
    {
        return new Field(
            $this->getContext(),
            new ResourcePathServiceOperation("getByInternalNameOrTitle",array($internalNameOrTitle),$this->getResourcePath())
        );
    }
}