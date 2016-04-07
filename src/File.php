<?php

namespace SharePoint\PHP\Client;

/**
 * File client object
 */
class File extends ClientObject
{


     public function checkOut(){
          $this->resourcePath =  $this->resourcePath . "/checkout";
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