<?php

namespace SharePoint\PHP\Client;


/**
 * List collection
 */
class ListCollection extends ClientObjectCollection
{
    /**
     * Get List by title
     * @param $title
     * @return SPList
     */
    public function getByTitle($title)
    {
        return new SPList(
            $this->getContext(),
            new ResourcePathServiceOperation($this->getContext(),$this->getResourcePath(),"getByTitle",array($title))
        );
    }

    /**
     * Get List by id
     * @param $id
     * @return SPList
     */
    public function getById($id)
    {
        return new SPList(
            $this->getContext(),
            new ResourcePathServiceOperation($this->getContext(),$this->getResourcePath(),"getById",array($id))
        );
    }


    /**
     * Creates a List resource
     * @param ListCreationInformation $parameters
     * @return SPList
     */
    public function add(ListCreationInformation $parameters)
    {
        $list = new SPList($this->getContext(),$this->getResourcePath());
        $qry = new ClientAction($list->getResourceUrl(),$parameters->toJson(),HttpMethod::Post);
        $this->getContext()->addQuery($qry,$list);
        $this->addChild($list);
        return $list;
    }
}