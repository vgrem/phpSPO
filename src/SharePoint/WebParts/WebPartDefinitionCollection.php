<?php


namespace Office365\SharePoint\WebParts;


use Office365\Runtime\ClientObjectCollection;
use Office365\Runtime\ResourcePath;

class WebPartDefinitionCollection extends ClientObjectCollection
{
    /**
     * Returns the Web Part definition object in the collection with a Web Part identifier equal to the id parameter.
     * @param string $id The Web Part identifier of the Web Part definition to retrieve.
     * @return WebPartDefinition
     */
    public function getById($id)
    {
        return new WebPartDefinition($this->getContext(),
            new ResourcePath("GetById('{$id}')",$this->getResourcePath()));
    }

    /**
     * @param string $controlId
     * @return WebPartDefinition
     */
    public function getByControlId($controlId)
    {
        return new WebPartDefinition($this->getContext(),
            new ResourcePath("GetByControlId('{$controlId}')",$this->getResourcePath()));
    }
}