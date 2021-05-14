<?php

/**
 * Modified: 2020-05-24T22:10:26+00:00 
 */
namespace Office365\OneDrive;

use Office365\Runtime\ClientValue;
class Video extends ClientValue
{
    /**
     * @var integer
     */
    public $AudioBitsPerSample;
    /**
     * @var integer
     */
    public $AudioChannels;
    /**
     * @var string
     */
    public $AudioFormat;
    /**
     * @var integer
     */
    public $AudioSamplesPerSecond;
    /**
     * @var integer
     */
    public $Bitrate;
    /**
     * @var integer
     */
    public $Duration;
    /**
     * @var string
     */
    public $FourCC;
    /**
     * @var double
     */
    public $FrameRate;
    /**
     * @var integer
     */
    public $Height;
    /**
     * @var integer
     */
    public $Width;
}