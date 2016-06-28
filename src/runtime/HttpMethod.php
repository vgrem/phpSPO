<?php

namespace SharePoint\PHP\Client;

/**
 * This header is a custom HTTP request header defined by this document.
 */
abstract class HttpMethod
{
    const Get = 1;
    const Post = 2;
    const Merge = 4;
    const Delete = 8;
    const Put = 16;
}