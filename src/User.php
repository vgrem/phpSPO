<?php


namespace SharePoint\PHP\Client;


class User  extends ClientObject
{
    public function update($userInformation)
    {
        if(!array_key_exists('__metadata',$userInformation)){
            $userInformation['__metadata'] = array( 'type' => 'SP.User' );
        }
        $this->payload = $userInformation;
        $qry = new ClientQuery($this,ClientOperationType::Update);
        $this->getContext()->addQuery($qry);
    }
}