<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Services\Geocoding;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Exception\GeocodingException;

/**
 * Geocoder request which describes a google map geocoder request.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#GeocoderRequest
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractGeocoderRequest
{
    /** @var \Ivory\GoogleMap\Base\Bound */
    protected $bound;

    /** @var string */
    protected $region;

    /** @var string */
    protected $language;

    /** @var boolean */
    protected $sensor;

    /**
     * Creates a geocoder request.
     */
    public function __construct()
    {
        $this->sensor = false;
    }

    /**
     * Checks if the geocoder request has a bound.
     *
     * @return boolean TRUE if the geocoder request has a bound else FALSE.
     */
    public function hasBound()
    {
        return $this->bound !== null;
    }

    /**
     * Gets the geocoder request bound.
     *
     * @return \Ivory\GoogleMap\Base\Bound The geocoder request bound.
     */
    public function getBound()
    {
        return $this->bound;
    }

    /**
     * Sets the geocoder request bound.
     *
     * @param \Ivory\GoogleMap\Base\Bound|null $bound The bound.
     */
    public function setBound(Bound $bound = null)
    {
        $this->bound = $bound;
    }

    /**
     * Checks if the geocoder request has a region.
     *
     * @return boolean TRUE if the geocoder request has a region else FALSE.
     */
    public function hasRegion()
    {
        return $this->region !== null;
    }

    /**
     * Gets the geocoder request region
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Sets the geocoder request region.
     *
     * @param string $region The geocoder request region.
     *
     * @throws \Ivory\GoogleMap\Exception\GeocodingException If the regin is not valid.
     */
    public function setRegion($region = null)
    {
        if ((!is_string($region) || (strlen($region) !== 2)) && ($region !== null)) {
            throw GeocodingException::invalidGeocoderRequestRegion();
        }

        $this->region = $region;
    }

    /**
     * Checks if the geocoder request has a language.
     *
     * @return boolean TRUE if the geocoder request has a language else FALSE.
     */
    public function hasLanguage()
    {
        return $this->language !== null;
    }

    /**
     * Gets the geocoder request language.
     *
     * @return string The geocoder request language.
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Sets the geocoder request language.
     *
     * @param string $language The geocoder request language.
     *
     * @throws \Ivory\GoogleMap\Exception\GeocodingException If the language is not valid.
     */
    public function setLanguage($language = null)
    {
        if ((!is_string($language) || ((strlen($language) !== 2) && (strlen($language) !== 5))) && ($language !== null)) {
            throw GeocodingException::invalidGeocoderRequestLanguage();
        }

        $this->language = $language;
    }

    /**
     * Checks if the geocoder request has a sensor.
     *
     * @return boolean TRUE if the geocoder request has a sensor else FALSE.
     */
    public function hasSensor()
    {
        return $this->sensor;
    }

    /**
     * Sets the geocoder request sensor.
     *
     * @param boolean $sensor TRUE if the geocoder request has a sensor else FALSE.
     *
     * @throws \Ivory\GoogleMap\Exception\GeocodingRequest If the sensor flag is not valid.
     */
    public function setSensor($sensor)
    {
        if (!is_bool($sensor)) {
            throw GeocodingException::invalidGeocoderRequestSensor();
        }

        $this->sensor = $sensor;
    }

    /**
     * Checks if the geocoder request is valid.
     *
     * @return boolean TRUE if the geocoder request is valid else FALSE.
     */
    abstract public function isValid();
}
