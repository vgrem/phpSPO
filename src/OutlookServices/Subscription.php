<?php


namespace Office365\OutlookServices;

/**
 * Class Subscription
 */
abstract class Subscription extends OutlookEntity
{

    /**
     * @var string
     */
    public $Resource;

    /**
     * @var int
     */
    public $ChangeType;


    /**
     * @var string
     */
    public $ClientState;
}