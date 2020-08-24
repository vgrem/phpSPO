<?php


namespace Office365\SharePoint;

use Office365\Runtime\Actions\ClientAction;
use Office365\Runtime\ClientResult;
use Office365\Runtime\Types\Guid;

/**
 *
 */
class UploadSession
{

    public function __construct()
    {
        $this->uploadSessionId = Guid::newGuid();
        $this->targetFile = null;
    }


    /**
     * @param FileCollection $files
     * @param string $sourcePath
     * @param string $targetFileName
     * @param callable $chunkUploaded
     * @param int $chunkSize
     */
    function buildQuery($files, $sourcePath, $targetFileName,  callable $chunkUploaded=null,$chunkSize = 1048576){
        $ctx= $files->getContext();
        $fileSize = filesize($sourcePath);
        $firstChunk = true;
        $handle = fopen($sourcePath, 'rb');
        $offset = 0;
        $fileCreationInformation = new FileCreationInformation();
        $fileCreationInformation->Url = $targetFileName;
        $uploadFile = $files->add($fileCreationInformation);
        $ctx->executeQuery();

        while (!feof($handle)) {
            $buffer = fread($handle, $chunkSize);
            $bytesRead = ftell ( $handle );
            if ($firstChunk) {
                $uploadFile->startUpload($this->uploadSessionId, $buffer);
                $firstChunk = false;
            } elseif ($fileSize == $bytesRead) {
                $this->targetFile = $uploadFile->finishUpload($this->uploadSessionId,$offset, $buffer);
            } else {
                $uploadFile->continueUpload($this->uploadSessionId,$offset, $buffer);
            }
            $offset = $bytesRead;
        }
        fclose($handle);


        if($chunkUploaded) {
            $ctx->afterExecuteQuery(function (ClientAction $query) use($chunkUploaded,$ctx)
            {
                $returnType = $query->ReturnType;
                if($returnType instanceof ClientResult){
                    call_user_func($chunkUploaded, $returnType->getValue());
                }
                elseif ($returnType instanceof File){
                    call_user_func($chunkUploaded, $returnType->getLength());
                }
            });
        }
    }


    /**
     * @return File
     */
    function getFile(){
        return $this->targetFile;
    }


    /**
     * @var Guid
     */
    private $uploadSessionId;


    /**
     * @var File
     */
    private $targetFile;

}