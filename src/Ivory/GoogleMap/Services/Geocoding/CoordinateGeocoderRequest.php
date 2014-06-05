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

use Ivory\GoogleMap\Base\Coordinate;

/**
 * Coordinate geocoder request which describes a google map geocoder request.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#GeocoderRequest
 * @author GeLo <geloen.eric@gmail.com>
 */
class CoordinateGeocoderRequest extends AbstractGeocoderRequest
{
    /** @var \Ivory\GoogleMap\Base\Coordinate */
    protected $coordinate;

    /**
     * Creates a coordinate geocoder request.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate $coordinate The coordinate.
     */
    public function __construct(Coordinate $coordinate)
    {
        parent::__construct();

        $this->setCoordinate($coordinate);
    }

    /**
     * Checks if the geocoder request has a coordinate.
     *
     * @return boolean TRUE if the geocoder request has a coordinate else FALSE.
     */
    public function hasCoordinate()
    {
        return $this->coordinate !== null;
    }

    /**
     * Gets the geocoder request coordinate.
     *
     * @return \Ivory\GoogleMap\Base\Coordinate The geocoder request coordinate.
     */
    public function getCoordinate()
    {
        return $this->coordinate;
    }

    /**
     * Sets the geocoder request coordinate.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate|null $coordinate The coordinate.
     */
    public function setCoordinate(Coordinate $coordinate = null)
    {
        $this->coordinate = $coordinate;
    }

    /**
     * Checks if the geocoder request is valid.
     *
     * @return boolean TRUE if the geocoder request is valid else FALSE.
     */
    public function isValid()
    {
        return $this->hasCoordinate();
    }
}
