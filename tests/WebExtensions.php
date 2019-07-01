<?php


use Office365\PHP\Client\SharePoint\WebCreationInformation;

class WebExtensions
{
    public static function createWeb(Office365\PHP\Client\SharePoint\ClientContext $ctx, $webUrl)
    {
        $web = $ctx->getWeb();
        $info = new WebCreationInformation($webUrl,$webUrl);
        $web = $web->getWebs()->add($info);
        $ctx->executeQuery();
        return $web;
    }

}
