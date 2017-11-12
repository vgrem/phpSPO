<?php


namespace Office365\PHP\Client\Runtime\OData;

/**
 * Enumerates the different kinds of payloads
 */
class ODataPayloadKind
{
    /**
     * Specifies an unknown format.
     */
    const Unsupported = -1;

    /**
     *
     */
    const Error = 0;

    /**
     * Specifies a payload kind for writing a collection.
     */
    const Collection = 1;

    /**
     * Specifies a payload kind for writing an entry.
     */
    const Entity = 2;

    /**
     * Specifies a payload kind for writing a property.
     */
    const Property = 3;


    /**
     *  Specifies a payload kind for writing a parameter.
     */
    const Parameter = 4;

    /**
     * Specifies the payload kind for writing a batch.
     */
    const Batch = 5;


    /**
     * Specifies a payload kind for writing a service document.
     */
    const ServiceDocument = 6;
}