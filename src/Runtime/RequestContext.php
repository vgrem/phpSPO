<?php


namespace Office365\Runtime;


use Office365\SharePoint\Site;
use Office365\SharePoint\Web;

class RequestContext extends ClientObject
{
    /**
     * @var Site
     */
    private $site;

    /**
     * @var Web
     */
    private $web;
    
    
    /**
     * @return Site
     */
    public function getSite()
    {
        if(!isset($this->site)){
            $this->site = new Site($this->getContext(),new ResourcePath("Site",$this->getResourcePath()));
        }
        return $this->site;
    }

    /**
     * @return mixed|null|Site
     */
    public function getWeb()
    {
        if(!isset($this->web)){
            $this->web = new Web($this->getContext(),new ResourcePath("Web",$this->getResourcePath()));
        }
        return $this->web;
    }


    public static function GetCurrent(ClientRuntimeContext $context)
    {
        static $current = null;
        if ($current === null) {
            $current = new RequestContext($context,null);
        }
        return $current;
    }


    protected function getServerTypeId()
    {
        return "{3747adcd-a3c3-41b9-bfab-4a64dd2f1e0a}";
    }

}