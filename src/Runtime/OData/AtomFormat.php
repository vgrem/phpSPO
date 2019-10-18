<?php


namespace Office365\PHP\Client\Runtime\OData;


use Exception;

class AtomFormat extends ODataFormat
{

    /**
     * @return string
     * @throws Exception
     */
    public function getMediaType()
    {
        throw new Exception("Not implemented");
    }
}
