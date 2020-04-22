<?php


namespace Office365\SharePoint;


use Office365\Runtime\ClientValueObject;

class AttachmentCreationInformation extends ClientValueObject
{

    /**
     * @var string
     */
    public $FileName;


    /**
     * @var string
     */
    public $ContentStream;

}