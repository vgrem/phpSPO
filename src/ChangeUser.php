<?php


namespace SharePoint\PHP\Client;


class ChangeUser extends Change
{
    /**
     * @var bool
     */
    public $Activate;

    /**
     * @var string
     */
    public $UserId;
}