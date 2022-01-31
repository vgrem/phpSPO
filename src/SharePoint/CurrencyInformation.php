<?php

/**
 * Generated 2021-10-09T13:26:01+03:00 16.0.21729.12001
 */
namespace Office365\SharePoint;

use Office365\Runtime\ClientValue;
/**
 * Information 
 * about a currency necessary for currency identification and display in the UI.
 */
class CurrencyInformation extends ClientValue
{
    /** 
     * The 
     * Display String (ex: $123,456.00 (United States)) for a specific currency which 
     * contains a sample formatted value (the currency and the number formatting from 
     * the web's locale) and the name of the country/region for the currency.
     * @var string
     */
    public $DisplayString;
    /** 
     * The LCID 
     * (locale identifier) for a specific currency.
     * @var string
     */
    public $LCID;
    /**
     * @var string
     */
    public $LanguageCultureName;
}