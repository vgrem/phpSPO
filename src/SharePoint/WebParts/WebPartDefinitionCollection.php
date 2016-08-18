<?php


namespace SharePoint\PHP\Client\WebParts;


use SharePoint\PHP\Client\ClientObjectCollection;

class WebPartDefinitionCollection extends ClientObjectCollection
{
    /**
     * Returns the Web Part definition object in the collection with a Web Part identifier equal to the id parameter.
     * @param string $id The Web Part identifier of the Web Part definition to retrieve.
     * @return WebPartDefinition
     */
    public function getById($id)
    {
        $webPartDefinition = new WebPartDefinition($this->getContext(),$this->getResourcePath() . "/GetById('{$id}')");
        return $webPartDefinition;
    }

    /**
     * @param string $controlId
     * @return WebPartDefinition
     */
    public function getByControlId($controlId)
    {
        $webPartDefinition = new WebPartDefinition($this->getContext(),$this->getResourcePath() . "/GetByControlId('{$controlId}')");
        return $webPartDefinition;
    }
}