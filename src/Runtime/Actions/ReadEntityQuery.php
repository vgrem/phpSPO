<?php


namespace Office365\Runtime\Actions;


use Office365\Runtime\ClientObject;

class ReadEntityQuery extends ClientAction
{
    /**
     * @param ClientObject $entityToRead
     * @param array|null $includeProperties
     */
    public function __construct(ClientObject $entityToRead, $includeProperties = array())
    {
        $bindingType = clone $entityToRead;
        if (is_null($includeProperties))
            $includeProperties = array();
        $expandProperties = array_filter($includeProperties, function ($name) use ($entityToRead) {
            $propType = $entityToRead->getProperty($name);
            return $propType instanceof ClientObject;
        });
        if (!empty($includeProperties))
            $bindingType->getQueryOptions()->Select = implode(",", $includeProperties);
        if (!empty($expandProperties) > 0)
            $bindingType->getQueryOptions()->Expand = implode(",", $expandProperties);
        parent::__construct($entityToRead->getContext(), $bindingType, $entityToRead);
    }
}