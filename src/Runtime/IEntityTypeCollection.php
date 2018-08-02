<?php


namespace Office365\PHP\Client\Runtime;



interface IEntityTypeCollection extends IEntityType
{

    function clearData();

    /**
     * Instantiates an item
     * @return IEntityType
     */
    function createType();


    /**
     * @param IEntityType $type
     */
    function addChild($type);
}