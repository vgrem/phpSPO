<?php


namespace SharePoint\PHP\Client\Runtime;
use ReflectionClass;
use ReflectionProperty;

/**
 * Represents the raw query values in the string format from the incoming request.
 */
class QueryOptions
{

    public function toUrl()
    {
        $reflection = new ReflectionClass($this);
        $allProps   = $reflection->getProperties(ReflectionProperty::IS_PUBLIC);
        $props = array_filter($allProps,
            function ($p) {
                $n = $p->getName();
                return isset($this->{$n});
            });

        $url = implode('&',array_map(
            function ($p) {
                $k = "\$" . strtolower($p->getName());
                $v = $this->{$p->getName()};
                return "$k=$v";
            },$props) 
        );
        return $url;
    }

    public $Select;
    
    public $Filter;

    public $Expand;
    
    public $OrderBy;

    public $Top;

    public $Skip;
}