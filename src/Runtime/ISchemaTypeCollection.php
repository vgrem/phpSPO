<?php


namespace Office365\PHP\Client\Runtime;



interface ISchemaTypeCollection
{

    function clearData();

    /**
     * Instantiates an item
     * @return ISchemaType
     */
    function createType();


    /**
     * @param ISchemaType $type
     */
    function addChild($type);
}