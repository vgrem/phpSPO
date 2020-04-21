<?php


namespace Office365\PHP\Client\Runtime\OData;

use Office365\PHP\Client\Runtime\ResourcePath;

class ODataPathBuilder
{


    /**
     * @param string $url
     * @return null|ResourcePath
     */
    public static function fromUrl($url){
        $segments = ODataPathBuilder::parseUrl($url);
        $path = null;
        foreach ($segments as $segment){
            $path = new ResourcePath($segment,$path);
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
