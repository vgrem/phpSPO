<?php


namespace Office365\Runtime\OData;


use Office365\Runtime\ClientRequest;
use Office365\Runtime\Http\RequestOptions;

class ODataBatchRequest extends ClientRequest
{
    //private $mediaType = "multipart/mixed";

    public function executeQuery()
    {
        //$batchBoundary = $this->createBoundary("batch_");
        parent::executeQuery();
    }


    public function buildRequest()
    {
        // TODO: Implement buildRequest() method.
    }

    /**
     * @param RequestOptions $request
     */
    protected function setRequestHeaders(RequestOptions $request)
    {
        // TODO: Implement setRequestHeaders() method.
    }

    /**
     * @param string $response
     */
    public function processResponse($response)
    {
        // TODO: Implement processResponse() method.
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
