<?php


namespace Office365\PHP\Client\Runtime\OData;


use Office365\PHP\Client\Runtime\ClientRuntimeContext;
use Office365\PHP\Client\Runtime\Utilities\RequestOptions;

class MetadataResolver
{

    /**
     * @param ClientRuntimeContext $ctx
     * @return string
     * @throws \Exception
     */
    public static function getMetadata(ClientRuntimeContext $ctx)
    {
        $metadataUrl = $ctx->getServiceRootUrl() . "/\$metadata";
        $options = new RequestOptions($metadataUrl);
        $content = $ctx->executeQueryDirect($options);
        return $content;
    }

}