<?php


namespace Office365\PHP\Client\Runtime\OData;


use Office365\PHP\Client\Runtime\ClientRuntimeContext;
use Office365\PHP\Client\Runtime\ResourcePathEntity;

class ODataPathBuilder
{


    /**
     * @param ClientRuntimeContext $context
     * @param string $url
     * @return null|ResourcePathEntity
     */
    public static function fromUrl(ClientRuntimeContext $context, $url){
        $segments = ODataPathBuilder::parseUrl($url);
        $path = null;
        foreach ($segments as $segment){
            $path = new ResourcePathEntity($context,$path,$segment);
        }
        return $path;
    }

    /**
     * @param $url
     * @return array
     */
    private static function parseUrl($url)
    {
        $level = 0;       // number of nested sets of brackets
        $segments = array(''); // array to return
        $idx = 0;         // current index in the array to return, for convenience

        $len = strlen($url);
        for ($i = 0; $i < $len; $i++) {
            switch ($url[$i]) {
                case '(':
                    $level++;
                    $segments[$idx] .= '(';
                    break;
                case ')':
                    $level--;
                    $segments[$idx] .= ')';
                    break;
                case '/':
                    if ($level == 0) {
                        $idx++;
                        $segments[$idx] = '';
                        break;
                    }
                // else fallthrough
                default:
                    $segments[$idx] .= $url[$i];
                    break;
            }
        }
        return $segments;
    }

}
