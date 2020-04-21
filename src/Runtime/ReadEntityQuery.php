<?php


namespace Office365\PHP\Client\Runtime;


class ReadEntityQuery extends ClientAction
{
    /**
     * @param ClientObject $entityToRead
     * @param array|null $selectProperties
     */
    public function __construct(ClientObject $entityToRead,$selectProperties = null)
    {
        if($selectProperties)
            $entityToRead->getQueryOptions()->Select = implode(",",$selectProperties);
        parent::__construct($entityToRead,$entityToRead);
    }
}