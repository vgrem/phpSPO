<?php

/**
 * Generated 2019-10-12T20:10:10+00:00 16.0.19402.12016
 */
namespace Office365\SharePoint\Taxonomy;

use Office365\Runtime\ClientValue;
use Office365\Runtime\ServerTypeInfo;

class TaxonomyFieldValue extends ClientValue
{
    public function __construct($label=null, $termGuid=null)
    {
        parent::__construct();
        $this->Label = $label;
        $this->TermGuid = $termGuid;
        $this->WssId = -1;
    }

    /**
     * @var string
     */
    public $Label;
    /**
     * @var string
     */
    public $TermGuid;
    /**
     * @var integer
     */
    public $WssId;

    public function __toString()
    {
        return "$this->WssId;#$this->Label|$this->TermGuid";
    }

    public function getServerTypeInfo()
    {
        return new ServerTypeInfo("SP.Taxonomy", "TaxonomyFieldValue");
    }
}