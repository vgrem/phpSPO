<?php

namespace SharePoint\PHP\Client;

/**
 * File client object
 */
class File extends ClientObject
{
     public static function OpenBinaryDirect(ClientContext $ctx,$serverRelativeUrl){
          $serverRelativeUrl = rawurlencode($serverRelativeUrl);
          $url = $ctx->getUrl() . "/_api/web/getfilebyserverrelativeurl('$serverRelativeUrl')/\$value";
          $data = $ctx->getPendingRequest()->executeQueryDirect($url,null,null);
          return $data;
     }
}