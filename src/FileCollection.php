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
        $resourcePath = $this->getResourcePath() . "/add(overwrite=true,url='{$fileUrl}')";
        $file = new File($this->getContext(),$resourcePath,null,$fileCreationInformation['Content']);
        $qry = new ClientQuery($file,ClientOperationType::Create);
        $qry->setBinaryStringRequestBody(true);
        $this->getContext()->addQuery($qry);
        $this->addChild($file);
        return $file;
    }

}