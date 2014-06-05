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

use Ivory\GoogleMap\Exception\GeocodingException;

/**
 * Address geocoder request which describes a google map geocoder request.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#GeocoderRequest
 * @author GeLo <geloen.eric@gmail.com>
 */
class AddressGeocoderRequest extends AbstractGeocoderRequest
{
    /** @var string */
    protected $address;

    /**
     * Creates a geocoder request.
     */
    public function __construct($address)
    {
        parent::__construct();

        $this->setAddress($address);
    }

    /**
     * Checks if the geocoder request has an address.
     *
     * @return boolean TRUE if the geocoder request has an address else FALSE.
     */
    public function hasAddress()
    {
        return !empty($this->address);
    }

    /**
     * Gets the geocoder request address.
     *
     * @return string The geocoder request address.
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Sets the geocoder request address.
     *
     * @param string $address The geocoder request address.
     *
     * @throws \Ivory\GoogleMap\Exception\GeocodingException If the address is not valid.
     */
    public function setAddress($address)
    {
        if (!is_string($address) && ($address !== null)) {
            throw GeocodingException::invalidGeocoderRequestAddress();
        }

        $this->address = $address;
    }

    /**
     * Checks if the geocoder request is valid.
     *
     * @return boolean TRUE if the geocoder request is valid else FALSE.
     */
    public function isValid()
    {
        return $this->hasAddress();
    }
}
