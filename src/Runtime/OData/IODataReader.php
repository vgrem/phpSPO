<?php

namespace Office365\PHP\Client\Runtime\OData;


interface IODataReader
{
    function generateModel($content);
}