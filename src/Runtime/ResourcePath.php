<?php


namespace Office365\Runtime;

class ResourcePath
{

    /**
     * ResourcePath constructor.
     * @param string $segment
     * @param ResourcePath|null $parent
     */
    public function __construct($segment, ResourcePath $parent = null)
    {
        $this->segment = $segment;
        $this->parent = $parent;
    }


    /**
     * @return string
     */
    public function getSegment(){
        return $this->segment;
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
        $segments = array();
        $current = clone $this;
        while (isset($current)) {
            if(!is_null($current->getSegment()))
                array_unshift($segments, $current->getSegment());
            $current = $current->getParent();
        }
        return implode("/", $segments);
    }

    /**
     * @var ResourcePath
     */
    protected $parent;

    /**
     * @var string $segment
     */
    protected $segment;


    /**
     * @var int
     */
    public $Id;
}
