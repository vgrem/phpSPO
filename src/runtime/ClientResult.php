<?php


namespace SharePoint\PHP\Client;


class ClientResult
{
    public function fromJson($data)
    {
        foreach($data as $key => $value){
            $this->$key = $value;
        }
    }

}