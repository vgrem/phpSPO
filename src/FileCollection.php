<?php

namespace SharePoint\PHP\Client;


/**
 * File collections
 *
 */
class FileCollection extends ClientObjectCollection
{

    /**
     * Creates a File resource
     * @param FileCreationInformation $fileCreationInformation
     * @return File
     */
    public function add(FileCreationInformation $fileCreationInformation)
    {
        $file = new File(
            $this->getContext(),
            new ResourcePathServiceOperation($this->getContext(),$this->getResourcePath(),"add",array(
                "overwrite"=>$fileCreationInformation->Overwrite,
                "url"=>rawurlencode($fileCreationInformation->Url)
            )));
        $qry = new ClientAction($file->getResourceUrl(),$fileCreationInformation->Content,HttpMethod::Post);
        $qry->setBinaryStringRequestBody(true);
        $this->getContext()->addQuery($qry,$file);
        //$this->addChild($file);
        return $file;
    }


    /**
     * Adds a ghosted file to an existing list or document library.
     * @param $urlOfFile
     * @param $templateFileType
     * @return File
     */
    public function addTemplateFile($urlOfFile,$templateFileType)
    {
        $file = new File(
            $this->getContext(),
            new ResourcePathServiceOperation($this->getContext(),$this->getResourcePath(),"addTemplateFile",array(
                "urlOfFile" => $urlOfFile,
                "templateFileType" => (int)$templateFileType
            )));
        $qry = new ClientAction($file->getResourceUrl(),null,HttpMethod::Post);
        $qry->setBinaryStringRequestBody(true);
        $this->getContext()->addQuery($qry,$file);
        return $file;
    }

}