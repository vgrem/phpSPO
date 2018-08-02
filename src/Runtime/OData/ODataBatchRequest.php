<?php


namespace Office365\PHP\Client\Runtime\OData;


class ODataBatchRequest extends ODataRequest
{
    //private $mediaType = "multipart/mixed";

    public function executeQuery()
    {
        //$batchBoundary = $this->createBoundary("batch_");
        parent::executeQuery();
    }


    function buildRequest()
    {
        return parent::buildRequest();
    }


    /**
     * Creates a string that can be used as a multipart request boundary.
     * @param $prefix String to use as the start of the boundary string
     * @return string Boundary string of the format: <prefix><hex16>-<hex16>-<hex16>
     */
    private function createBoundary($prefix){
        return $prefix . $this->hex16() . "-" . $this->hex16() . "-" . $this->hex16();
    }


    /**
     * Calculates a random 16 bit number and returns it in hexadecimal format.
     * @return string A 16-bit number in hex format.
     */
    private function hex16(){
        $val = dechex(floor((1 + ((float)rand()/(float)getrandmax())) * 0x10000));
        return substr($val,0,-1);
    }

}