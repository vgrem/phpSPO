<?php


namespace Office365\Runtime;

class ResourcePath
{

    /**
     * @param string $name
     * @param ResourcePath|null $parent
     */
    public function __construct($name, ResourcePath $parent = null)
    {
        $this->name = $name;
        $this->parent = $parent;
    }

    /**
     * @return string[]
     */
    public function getSegments(){
        return ["/", $this->name];
    }

    /**
     * @return string
     */
    public function getName(){
        return $this->name;
    }


    /**
     * @return null|ResourcePath
     */
    public function getParent(){
        return $this->parent;
    }

    /**
     * @return string
     */
    public function toUrl()
    {
        $allSegments = array();
        $current = clone $this;
        while (isset($current)) {
            $allSegments = array_merge($current->getSegments(), $allSegments);
            $current = $current->getParent();
        }
        return implode("", $allSegments);
    }

    /**
     * @var ResourcePath
     */
    protected $parent;

    /**
     * @var string $segment
     */
    protected $name;

}
