<?php

/**
 * Modified: 2020-05-24T22:10:26+00:00 
 */
namespace Office365\OneDrive;

use Office365\Runtime\ClientValue;
class Audio extends ClientValue
{
    /**
     * @var string
     */
    public $Album;
    /**
     * @var string
     */
    public $AlbumArtist;
    /**
     * @var string
     */
    public $Artist;
    /**
     * @var integer
     */
    public $Bitrate;
    /**
     * @var string
     */
    public $Composers;
    /**
     * @var string
     */
    public $Copyright;
    /**
     * @var integer
     */
    public $Duration;
    /**
     * @var string
     */
    public $Genre;
    /**
     * @var bool
     */
    public $HasDrm;
    /**
     * @var bool
     */
    public $IsVariableBitrate;
    /**
     * @var string
     */
    public $Title;
    /**
     * @var integer
     */
    public $Track;
    /**
     * @var integer
     */
    public $TrackCount;
    /**
     * @var integer
     */
    public $Year;
}