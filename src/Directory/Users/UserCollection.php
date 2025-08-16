<?php


namespace Office365\Directory\Users;


use Office365\EntityCollection;
use Office365\Runtime\ClientObject;
use Office365\Runtime\ClientRuntimeContext;
use Office365\Runtime\ResourcePath;

class UserCollection extends EntityCollection
{

    public function __construct(ClientRuntimeContext $ctx, ?ResourcePath $resourcePath = null)
    {
        parent::__construct($ctx, $resourcePath, User::class);
    }

    /**
     * @param string $value User principal name
     * @return User
     */
    function getByUserPrincipalName($value)
    {
        /** @var User $user */
        $user = $this->createType(new ResourcePath($value, $this->getResourcePath()));
        return $user;
    }

}