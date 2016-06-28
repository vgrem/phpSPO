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
        $file = new File(
            $this->getContext(),
            new ResourcePathServiceOperation($this->getContext(),$this->getResourcePath(),"add",array(
                "overwrite"=>true,
                "url"=>rawurlencode($fileCreationInformation['Url'])
            )));
        $qry = new ClientAction($file->getResourceUrl(),$fileCreationInformation['Content'],HttpMethod::Post);
        $qry->setBinaryStringRequestBody(true);
        $this->getContext()->addQuery($qry,$file);
        //$this->addChild($file);
        return $file;
    }

}