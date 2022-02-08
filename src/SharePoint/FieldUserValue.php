<?php

/**
 * Represents the value of a user field for a list item. Inherits from SP.FieldLookupValue.
 */
/**
 * Generated 2019-10-06T21:42:09+00:00
*/
namespace Office365\SharePoint;

class FieldUserValue extends FieldLookupValue
{

    /**
     * Initialize field value from User
     * @param User $user
     * @return FieldUserValue
     */
    public static function fromUser($user){
        $value = new FieldUserValue(-1);
        $user->ensureProperty("Id",function () use($value, $user){
            $value->LookupId = $user->getId();
            $value->LookupValue = $user->getLoginName();
        });
        return $value;
    }


    public $Email;
}