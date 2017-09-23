<?php


class WebExtensions
{
    public static function createWeb(Office365\PHP\Client\SharePoint\ClientContext $ctx, $webUrl)
    {
        $web = $ctx->getWeb();
        $info = new \Office365\PHP\Client\SharePoint\WebCreationInformation($webUrl,$webUrl);
        $web = $web->getWebs()->add($info);
        $ctx->executeQuery();
        return $web;
    }

}