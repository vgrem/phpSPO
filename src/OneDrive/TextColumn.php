<?php

/**
 * Modified: 2020-05-26T22:07:25+00:00 
 */
namespace Office365\OneDrive;

use Office365\Runtime\ClientValue;
class TextColumn extends ClientValue
{
    /**
     * @var bool
     */
    public $AllowMultipleLines;
    /**
     * @var bool
     */
    public $AppendChangesToExistingText;
    /**
     * @var integer
     */
    public $LinesForEditing;
    /**
     * @var integer
     */
    public $MaxLength;
    /**
     * @var string
     */
    public $TextType;
}