<?php
/**
 * Represents base permissions for a role definition.
 */

namespace SharePoint\PHP\Client;


class BasePermissions extends ClientValueObject
{
    /**
     * The bitwise high-order boundary (higher 32 bits) of the permission.
     * @var int
     */
    public $High;


    /**
     * The bitwise low-order boundary (lower 32 bits) of the permission.
     * @var int
     */
    public $Low;

}