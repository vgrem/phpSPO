<?php


namespace Office365\PHP\Client\Runtime;


abstract class ResourcePath
{
    /**
     * ResourcePath constructor.
     * @param ClientRuntimeContext $context
     * @param ResourcePath|null $parent
     */
    public function __construct(ClientRuntimeContext $context, ResourcePath $parent = null)
    {
        $this->context = $context;
        $this->parent = $parent;
        $this->ServerObjectIsNull = true;
    }


    /**
     * @return ClientRuntimeContext
     */
    public function getContext(){
        return $this->context;
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
        $paths = array();
        $current = clone $this;
        while (isset($current)) {
            if(!is_null($current->toString()))
                array_unshift($paths, $current->toString());
            $current = $current->parent;
        }
        return implode("/", $paths);
    }


    /**
     * @return string
     */
    public abstract function toString();


    /**
     * @var ResourcePath
     */
    protected $parent;


    /**
     * @var ClientRuntimeContext
     */
    protected $context;


    /**
     * @var bool
     */
    public $ServerObjectIsNull;


    /**
     * @var int
     */
    public $Id;

}