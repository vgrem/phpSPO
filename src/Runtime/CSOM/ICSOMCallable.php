<?php


namespace Office365\PHP\Client\Runtime\CSOM;


use SimpleXMLElement;

interface ICSOMCallable
{
    function buildQuery(SimpleXMLElement $writer);
}