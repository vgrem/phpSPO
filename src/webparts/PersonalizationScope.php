<?php
/**
 * Created by PhpStorm.
 * User: vgrem
 * Date: 5/15/2016
 * Time: 9:28 PM
 */

namespace SharePoint\PHP\Client\WebParts;


use SharePoint\PHP\Client\Enum;

class PersonalizationScope extends Enum
{
    const User = 0;
    const Shared = 1;
}