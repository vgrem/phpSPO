<?php

/**
 * Modified: 2020-05-25T06:42:59+00:00
 */
namespace Office365\Common;


use Office365\Runtime\ClientValue;
class IdentitySet extends ClientValue
{

    public function getProperty($name, $defaultValue = null)
    {
        if($name == "Application")
            $defaultValue = new Identity();
        elseif ($name == "Device")
            $defaultValue = new Identity();
        elseif ($name == "User")
            $defaultValue = new Identity();
        return parent::getProperty($name, $defaultValue);
    }


    /**
     * @var Identity
     */
    public $Application;
    /**
     * @var Identity
     */
    public $Device;
    /**
     * @var Identity
     */
    public $User;

}