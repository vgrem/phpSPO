<?php
/**
 * Created by PhpStorm.
 * User: vgrem
 * Date: 4/22/2016
 * Time: 11:24 AM
 */

namespace SharePoint\PHP\Client;


class ChangeCollection extends ClientObjectCollection
{
     public function getEntityTypeName()
     {
         return "SP.ChangeQuery";
     }
}