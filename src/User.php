<?php


namespace SharePoint\PHP\Client;


class User  extends ClientObject
{
    public function update($userInformation)
    {
        $this->payload = $userInformation;
        $qry = new ClientQuery($this,ClientOperationType::Update);
        $this->getContext()->addQuery($qry);
    }


}