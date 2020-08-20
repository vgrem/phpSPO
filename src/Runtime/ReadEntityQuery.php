<?php


namespace Office365\Runtime;


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
            $propType = $entityToRead->getPropertyType($name);
            if ($propType instanceof ClientObject) {
                return $name;
            }
        });
        if (!empty($includeProperties))
            $bindingType->getQueryOptions()->Select = implode(",", $includeProperties);
        if (!empty($expandProperties) > 0)
            $bindingType->getQueryOptions()->Expand = implode(",", $expandProperties);
        parent::__construct($bindingType, $entityToRead);
    }
}