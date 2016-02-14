<?php
namespace SharePoint\PHP\Client;

class XmlUtilities
{
    /**
     * Encodes string
     * @param mixed $value
     * @return mixed
     */
    public static function xmlEncode($value)
    {
        $encName = rawurlencode($value);
        $encName = str_replace("%20", "_x0020_", $encName);
        return $encName;
    }
}
