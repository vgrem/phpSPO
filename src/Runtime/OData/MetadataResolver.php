<?php


namespace Office365\Runtime\OData;


use Office365\Runtime\ClientRuntimeContext;
use Office365\Runtime\Http\RequestOptions;

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
        $response = $ctx->executeQueryDirect($options);
        return $response->getContent();
    }

}
