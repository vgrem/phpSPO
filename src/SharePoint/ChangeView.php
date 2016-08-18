<?php


namespace SharePoint\PHP\Client;


class ChangeView extends Change
{
    /**
     * @var string
     */
    public $ListId;


    /**
     * @var string
     */
    public $ViewId;

    /**
     * @var string
     */
    public $WebId;
}