<?php


namespace Office365\PHP\Client\OneDrive;

use Exception;
use Office365\PHP\Client\Runtime\ClientObjectCollection;

class ItemCollection extends ClientObjectCollection
{

    function add($name,$type,$content){
        /*$payload = new File($this->getContext());
        //$payload->setContent($content);
        $qry = new InvokePostMethodQuery($this, "add",null,$payload);
        $this->getContext()->addQuery($qry);*/
        throw new Exception("Not implemented: ItemCollection.add");
    }


}