<?php

namespace SharePoint\PHP\Client;


/**
 * File collections
 *
 */
class FileCollection extends ClientObjectCollection
{

    public function add(array $fileCreationInformation)
    {
        $fileUrl = rawurlencode($fileCreationInformation['Url']);
        $file = new File($this->getContext());
        $qry = new ClientQuery($this->getUrl() . "/add(overwrite=true,url='{$fileUrl}')",ClientActionType::Create,$fileCreationInformation['Content']);
        $qry->setBinaryStringRequestBody(true);
        $this->getContext()->addQuery($qry,$file);
        //$this->addChild($file);
        return $file;
    }

}