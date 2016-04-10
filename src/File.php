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
      * Copies the file to the destination URL.
      * @param string $strNewUrl The absolute URL or server relative URL of the destination file path to copy to.
      * @param bool $bOverWrite true to overwrite a file with the same name in the same location; otherwise false.
      */
     public function copyTo($strNewUrl,$bOverWrite){
          $this->resourcePath =  $this->resourcePath . "/copyto(strnewurl='$strNewUrl',boverwrite=$bOverWrite)";
          $qry = new ClientQuery($this, ClientOperationType::Update);
          $this->getContext()->addQuery($qry);
     }


     public static function OpenBinaryDirect(ClientContext $ctx,$serverRelativeUrl){
          $serverRelativeUrl = rawurlencode($serverRelativeUrl);
          $url = $ctx->getUrl() . "/_api/web/getfilebyserverrelativeurl('$serverRelativeUrl')/\$value";
          $data = $ctx->getPendingRequest()->executeQueryDirect($url,null,null);
          return $data;
     }

     //Note: currently it supports only updating the existing file
     public static function SaveBinaryDirect(ClientContext $ctx,$serverRelativeUrl,$content){
          $serverRelativeUrl = rawurlencode($serverRelativeUrl);
          $url = $ctx->getUrl() . "/_api/web/getfilebyserverrelativeurl('$serverRelativeUrl')/\$value";
          $headers = array();
          $headers["X-HTTP-Method"] = "PUT";
          $ctx->getPendingRequest()->executeQueryDirect($url,$headers,$content);
     }
}