<?php


namespace Office365\Runtime\CSOM;


use SimpleXMLElement;

interface ICSOMCallable
{
    function buildQuery(SimpleXMLElement $writer);
}