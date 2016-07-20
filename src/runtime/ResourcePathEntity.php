<?php


namespace SharePoint\PHP\Client;

/**
 * Resource path  for addressing a Collection (of Entries), a single Entry within a Collection, 
 * as well as a property of an Entry
 */
class ResourcePathEntity extends ResourcePath
{

    /**
     * ResourcePathEntry constructor.
     * @param ClientContext $context
     * @param ResourcePath $parent
     * @param $entityName
     */
    public function __construct(ClientContext $context, ResourcePath $parent = null, $entityName)
    {
        parent::__construct($context, $parent);
        $this->entityName = $entityName;
    }


    /**
     * @return string
     */
    protected function getValue()
    {
        return $this->entityName;
    }
    

    /**
     * @var string
     */
    protected $entityName;
    
}