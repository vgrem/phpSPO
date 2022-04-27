<?php

namespace Office365\Runtime\Paths;

use Office365\Runtime\ResourcePath;

/**
 *  Resource path for addressing a single entity
 */
class EntityPath extends ResourcePath
{

    /**
     * @param string|null $key
     * @param ResourcePath|null $parent
     */
    public function __construct($key = null, ResourcePath $parent = null)
    {
        parent::__construct($key, $parent);
    }

    /**
     * @param $key
     */
    public function setKey($key)
    {
        $this->name = $key;
    }

    /**
     * @return string[]
     */
    public function getSegments()
    {
        $entityKey = self::isUuid($this->name) ? "guid'$this->name'" :
            (is_string($this->name) ? "'$this->name'" : $this->name);
        return ["(", $entityKey, ")"];
    }

    /**
     * @param $value
     * @return bool
     */
    private static function isUuid($value)
    {
        if (!is_string($value) || (preg_match(self::$uuidPattern, $value) !== 1)) {
            return false;
        }
        return true;
    }


    private static $uuidPattern = '/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/';

}