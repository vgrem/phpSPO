<?php
/**
 * Represents a collection of Field resources
 */

namespace SharePoint\PHP\Client;


class FieldCollection extends ClientObjectCollection
{

    /**
     * Creates a Field resource
     * @param FieldCreationInformation $parameters
     * @return Field
     */
    public function add(FieldCreationInformation $parameters)
    {
        $field = new Field($this->getContext(),$this->getResourcePath());
        $qry = new ClientActionCreateEntity($this,$parameters);
        $this->getContext()->addQuery($qry,$field);
        $this->addChild($field);
        return $field;
    }

    

    public function getByTitle($title)
    {
        return new Field(
            $this->getContext(),
            new ResourcePathServiceOperation($this->getContext(),$this->getResourcePath(),"getByTitle",array($title))
        );
    }

    public function getByInternalNameOrTitle($internalNameOrTitle)
    {
        return new Field(
            $this->getContext(),
            new ResourcePathServiceOperation($this->getContext(),$this->getResourcePath(),"getByInternalNameOrTitle",array($internalNameOrTitle))
        );
    }
}