<?php


namespace SharePoint\PHP\Client;


use SharePoint\PHP\Client\Runtime\ODataPathParser;

abstract class ResourcePath
{
    /**
     * ResourcePath constructor.
     * @param ClientContext $context
     * @param ResourcePath|null $parent
     */
    public function __construct(ClientContext $context, ResourcePath $parent = null)
    {
        $this->context = $context;
        $this->parent = $parent;
    }

    /**
     * @return ClientContext
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
     * @param ClientContext $context
     * @param string $value
     * @return null|ResourcePathEntity
     */
    public static function parse(ClientContext $context,$value){

        $pathNames = ODataPathParser::parsePathString($value);
        $path = null;
        foreach ($pathNames as $pathName){
            $path = new ResourcePathEntity($context,$path,$pathName);
        }
        return $path;
    }




    /**
     * @return string
     */
    public function toUrl()
    {
        $paths = array();
        $current = clone $this;
        while (isset($current)) {
            array_unshift($paths, $current->getValue());
            $current = $current->parent;
        }
        return implode("/", $paths);
    }
    
    protected abstract function getValue();
    
    

    /**
     * @var ResourcePath
     */
    protected $parent;


    /**
     * @var ClientContext
     */
    protected $context;

}