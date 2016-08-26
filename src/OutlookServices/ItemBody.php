<?php


namespace Office365\PHP\Client\OutlookServices;


use Office365\PHP\Client\Runtime\ClientValueObject;

class ItemBody extends ClientValueObject
{

    /**
     * @var string
     */
    public $ContentType;


    /**
     * @var string
     */
    public $Content;

}