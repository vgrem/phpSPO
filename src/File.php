<?php

namespace SharePoint\PHP\Client;

/**
 * File client object
 */
class File extends ClientObject
{

     /**
      * Checks out the file from a document library based on the check-out type.
      */
     public function checkOut(){
          $this->resourcePath =  $this->resourcePath . "/checkout";
          $qry = new ClientQuery($this, ClientOperationType::Update);
          $this->getContext()->addQuery($qry);
     }


     /**
      * Reverts an existing checkout for the file.
      */
     public function undoCheckout(){
          $this->resourcePath =  $this->resourcePath . "/undocheckout";
          $qry = new ClientQuery($this, ClientOperationType::Update);
          $this->getContext()->addQuery($qry);
     }


     /**
      * Checks the file in to a document library based on the check-in type.
      * @param string $comment A comment for the check-in. Its length must be <= 1023.
      */
     public function checkIn($comment){
          $this->resourcePath =  $this->resourcePath . "/checkin(comment='$comment',checkintype=0)";
          $qry = new ClientQuery($this, ClientOperationType::Update);
          $this->getContext()->addQuery($qry);
     }



     /**
      * Approves the file submitted for content approval with the specified comment.
      * @param string $comment The comment for the approval.
      */
     public function approve($comment){
          $this->resourcePath =  $this->resourcePath . "/approve(comment='$comment')";
          $qry = new ClientQuery($this, ClientOperationType::Update);
          $this->getContext()->addQuery($qry);
     }

     /**
      * Denies approval for a file that was submitted for content approval.
      * @param string $comment The comment for the denial.
      */
     public function deny($comment){
          $this->resourcePath =  $this->resourcePath . "/deny(comment='$comment')";
          $qry = new ClientQuery($this, ClientOperationType::Update);
          $this->getContext()->addQuery($qry);
     }

     /**
      * Submits the file for content approval with the specified comment.
      * @param string $comment The comment for the published file. Its length must be <= 1023.
      */
     public function publish($comment){
          $this->resourcePath =  $this->resourcePath . "/publish(comment='$comment')";
          $qry = new ClientQuery($this, ClientOperationType::Update);
          $this->getContext()->addQuery($qry);
     }


     /**
      * Removes the file from content approval or unpublish a major version.
      * @param string $comment The comment for the unpublish operation. Its length must be <= 1023.
      */
     public function unpublish($comment){
          $this->resourcePath =  $this->resourcePath . "/unpublish(comment='$comment')";
          $qry = new ClientQuery($this, ClientOperationType::Update);
          $this->getContext()->addQuery($qry);
     }


     /**
      * Copies the file to the destination URL.
      * @param string $strNewUrl The absolute URL or server relative URL of the destination file path to copy to.
      * @param bool $bOverWrite true to overwrite a file with the same name in the same location; otherwise false.
      */
     public function copyTo($strNewUrl,$bOverWrite){
          $this->resourcePath =  $this->resourcePath . "/copyto(strnewurl='$strNewUrl',boverwrite=$bOverWrite)";
          $qry = new ClientQuery($this, ClientOperationType::Update);
          $this->getContext()->addQuery($qry);
     }

     /**
      * Moves the file to the specified destination URL.
      * @param string $newUrl The absolute URL or server relative URL of the destination file path to move to.
      * @param int $flags The bitwise SP.MoveOperations value for how to move the file. Overwrite = 1; AllowBrokenThickets (move even if supporting files are separated from the file) = 8.
      */
     public function moveTo($newUrl,$flags){
          $this->resourcePath =  $this->resourcePath . "/moveto(newurl='$newUrl',flags=$flags)";
          $qry = new ClientQuery($this, ClientOperationType::Update);
          $this->getContext()->addQuery($qry);
     }


     /**
      * Moves the file to the Recycle Bin and returns the identifier of the new Recycle Bin item.
      */
     public function recycle(){
          $this->resourcePath =  $this->resourcePath . "/recycle";
          $qry = new ClientQuery($this, ClientOperationType::Update);
          $this->getContext()->addQuery($qry);
     }


     /**
      * Opens the file
      * @param ClientContext $ctx
      * @param $serverRelativeUrl
      * @return mixed|string
      */
     public static function openBinary(ClientContext $ctx,$serverRelativeUrl){
          $serverRelativeUrl = rawurlencode($serverRelativeUrl);
          $url = $ctx->getUrl() . "/_api/web/getfilebyserverrelativeurl('$serverRelativeUrl')/\$value";
          $data = $ctx->getPendingRequest()->executeQueryDirect($url,null,null);
          return $data;
     }

     /**
      * Saves the file
      * Note: it is supported to update the existing file only. For adding a new file see FileCollection.add method
      * @param ClientContext $ctx
      * @param $serverRelativeUrl
      * @param $content file content
      */
     public static function saveBinary(ClientContext $ctx,$serverRelativeUrl,$content){
          $serverRelativeUrl = rawurlencode($serverRelativeUrl);
          $url = $ctx->getUrl() . "/_api/web/getfilebyserverrelativeurl('$serverRelativeUrl')/\$value";
          $headers = array();
          $headers["X-HTTP-Method"] = "PUT";
          $ctx->getPendingRequest()->executeQueryDirect($url,$headers,$content);
     }
}