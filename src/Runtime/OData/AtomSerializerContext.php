<?php


namespace Office365\PHP\Client\Runtime\OData;


class AtomSerializerContext extends ODataSerializerContext
{

    /**
     * @return string
     * @throws \Exception
     */
    public function getMediaType()
    {
        throw new \Exception("Not implemented");
    }
}