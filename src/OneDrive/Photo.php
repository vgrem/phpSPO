<?php

/**
 * Modified: 2020-05-24T22:10:26+00:00 
 */
namespace Office365\OneDrive;

use Office365\Runtime\ClientValue;
class Photo extends ClientValue
{
    /**
     * @var string
     */
    public $CameraMake;
    /**
     * @var string
     */
    public $CameraModel;
    /**
     * @var double
     */
    public $ExposureDenominator;
    /**
     * @var double
     */
    public $ExposureNumerator;
    /**
     * @var double
     */
    public $FNumber;
    /**
     * @var double
     */
    public $FocalLength;
    /**
     * @var integer
     */
    public $Iso;
}