<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Services\DistanceMatrix;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Exception\DistanceMatrixException;
use Ivory\GoogleMap\Services\Base\TravelMode;
use Ivory\GoogleMap\Services\Base\UnitSystem;

/**
 * DistanceMatrixRequest represents a google map distance matrix query.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#DistanceMatrixRequest
 * @author GeLo <geloen.eric@gmail.com>
 * @author Tyler Sommer <sommertm@gmail.com>
 */
class DistanceMatrixRequest
{
    /** @var boolean */
    protected $avoidHighways;

    /** @var boolean */
    protected $avoidTolls;

    /** @var array */
    protected $destinations;

    /** @var array */
    protected $origins;

    /** @var string */
    protected $region;

    /** @var string */
    protected $language;

    /** @var string */
    protected $travelMode;

    /** @var string */
    protected $unitSystem;

    /** @var boolean */
    protected $sensor;

    /**
     * Creates a distance matrix request.
     *
     * @param array $origins      The origins.
     * @param array $destinations The destinations.
     */
    public function __construct(array $origins, array $destinations)
    {
        $this->setOrigins($origins);
        $this->setDestinations($destinations);
        $this->sensor = false;
    }

    /**
     * Checks if the distance matrix request has an avoid hightways flag.
     *
     * @return boolean TRUE if the distance matrix request has an avoid hightways flag else FALSE.
     */
    public function hasAvoidHighways()
    {
        return $this->avoidHighways !== null;
    }

    /**
     * Checks if the distance matrix request avoid hightways.
     *
     * @return boolean TRUE if the distance matrix request avoids hightways else FALSE.
     */
    public function getAvoidHighways()
    {
        return $this->avoidHighways;
    }

    /**
     * Sets if the the distance matrix request avoids hightways.
     *
     * @param boolean $avoidHighways TRUE if the distance matrix request avoids hightways else FALSE.
     *
     * @throws \Ivory\GoogleMap\Exception\DistanceMatrixException If the avoid highways flag is not valid.
     */
    public function setAvoidHighways($avoidHighways = null)
    {
        if (!is_bool($avoidHighways) && ($avoidHighways !== null)) {
            throw DistanceMatrixException::invalidDistanceMatrixRequestAvoidHighways();
        }

        $this->avoidHighways = $avoidHighways;
    }

    /**
     * Checks if the distance matrix request has an avoid tolls flag.
     *
     * @return boolean TRUE if the distance matrix request has an avoid tolls flag else FALSE.
     */
    public function hasAvoidTolls()
    {
        return $this->avoidTolls !== null;
    }

    /**
     * Checks if the distance matrix request avoid tolls.
     *
     * @return boolean TRUE if the distance matrix request avoids tolls else FALSE.
     */
    public function getAvoidTolls()
    {
        return $this->avoidTolls;
    }

    /**
     * Sets if the the distance matrix request avoids tolls.
     *
     * @param boolean $avoidTolls TRUE if the distance matrix request avoids tolls else FALSE.
     *
     * @throws \Ivory\GoogleMap\Exception\DistanceMatrixException If the avoid tolls flag is not valid.
     */
    public function setAvoidTolls($avoidTolls = null)
    {
        if (!is_bool($avoidTolls) && ($avoidTolls !== null)) {
            throw DistanceMatrixException::invalidDistanceMatrixRequestAvoidTolls();
        }

        $this->avoidTolls = $avoidTolls;
    }

    /**
     * Checks if the distance matrix request has destinations.
     *
     * @return boolean TRUE if the distance matrix request has a destination else FALSE.
     */
    public function hasDestinations()
    {
        return !empty($this->destinations);
    }

    /**
     * Gets the distance matrix request destinations
     *
     * @return array The distance matrix request destination.
     */
    public function getDestinations()
    {
        return $this->destinations;
    }

    /**
     * Sets the request destinations.
     *
     * @param array $destinations The distance matrix request destinations.
     */
    public function setDestinations(array $destinations = array())
    {
        $this->destinations = array();

        foreach ($destinations as $destination) {
            $this->addDestination($destination);
        }
    }

    /**
     * Adds a destination to the request.
     *
     * @param string|\Ivory\GoogleMap\Base\Coordinate $destination The coordinate.
     *
     * @throws \Ivory\GoogleMap\Exception\DistanceMatrixException If the destination is invalid.
     */
    public function addDestination($destination)
    {
        if (isset($destination) && (is_string($destination) || $destination instanceof Coordinate)) {
            $this->destinations[] = $destination;
        } else {
            throw DistanceMatrixException::invalidDistanceMatrixRequestDestination();
        }
    }

    /**
     * Checks if the distance matrix request has origins.
     *
     * @return boolean TRUE if the distance matrix request has origins else FALSE.
     */
    public function hasOrigins()
    {
        return !empty($this->origins);
    }

    /**
     * Gets the distance matrix request origin.
     *
     * @return array The distance matrix request origin.
     */
    public function getOrigins()
    {
        return $this->origins;
    }

    /**
     * Sets the request origins.
     *
     * @param array $origins The distance matrix request origins.
     */
    public function setOrigins(array $origins = array())
    {
        $this->origins = array();

        foreach ($origins as $origin) {
            $this->addOrigin($origin);
        }
    }

    /**
     * Adds an origin to the request.
     *
     * @param string|\Ivory\GoogleMap\Base\Coordinate $origin The origin.
     *
     * @throws \Ivory\GoogleMap\Exception\DistanceMatrixException If the origin is invalid.
     */
    public function addOrigin($origin)
    {
        if (isset($origin) && (is_string($origin) || $origin instanceof Coordinate)) {
            $this->origins[] = $origin;
        } else {
            throw DistanceMatrixException::invalidDistanceMatrixRequestOrigin();
        }
    }

    /**
     * Checks if the distance matrix request has a region.
     *
     * @return boolean TRUE if the distance matrix request has a region else FALSE.
     */
    public function hasRegion()
    {
        return $this->region !== null;
    }

    /**
     * Gets the distance matrix request region.
     *
     * @return string The direction request region.
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Sets the distance matrix request region.
     *
     * @param string $region The distance matrix request region.
     *
     * @throws \Ivory\GoogleMap\Exception\DistanceMatrixException If the region is not valid.
     */
    public function setRegion($region = null)
    {
        if ((!is_string($region) || (strlen($region) !== 2)) && ($region !== null)) {
            throw DistanceMatrixException::invalidDistanceMatrixRequestRegion();
        }

        $this->region = $region;
    }

    /**
     * Checks if the distance matrix request has a language.
     *
     * @return boolean TRUE if the distance matrix request has a language else FALSE.
     */
    public function hasLanguage()
    {
        return $this->language !== null;
    }

    /**
     * Gets the distance matrix request language.
     *
     * @return string The direction request language.
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Sets the distance matrix request language.
     *
     * @param string $language The distance matrix request language.
     *
     * @throws \Ivory\GoogleMap\Exception\DistanceMatrixException If the language is not valid.
     */
    public function setLanguage($language = null)
    {
        if ((!is_string($language) || ((strlen($language) !== 2) && (strlen($language) !== 5))) && ($language !== null)) {
            throw DistanceMatrixException::invalidDistanceMatrixRequestLanguage();
        }

        $this->language = $language;
    }

    /**
     * Checks if the distance matrix request has a travel mode.
     *
     * @return boolean TRUE if the distance matrix request has a travel mode else FALSE.
     */
    public function hasTravelMode()
    {
        return $this->travelMode !== null;
    }

    /**
     * Gets the distance matrix request travel mode.
     *
     * @return string The distance matrix request travel mode.
     */
    public function getTravelMode()
    {
        return $this->travelMode;
    }

    /**
     * Sets the distance matrix request travel mode.
     *
     * @param string $travelMode The distance matrix request travel mode.
     *
     * @throws \Ivory\GoogleMap\Exception\DistanceMatrixException If the travel mode is not valid.
     */
    public function setTravelMode($travelMode = null)
    {
        $travelModes = array_diff(TravelMode::getTravelModes(), array(TravelMode::TRANSIT));

        if (!in_array($travelMode, $travelModes) && ($travelMode !== null)) {
            throw DistanceMatrixException::invalidDistanceMatrixRequestTravelMode();
        }

        $this->travelMode = $travelMode;
    }

    /**
     * Checks if the distance matrix request has a unit system.
     *
     * @return boolean TRUE if the distance matrix request has a unit system else FALSE.
     */
    public function hasUnitSystem()
    {
        return $this->unitSystem !== null;
    }

    /**
     * Gets the distance matrix request unit system.
     *
     * @return string The distance matrix request unit system.
     */
    public function getUnitSystem()
    {
        return $this->unitSystem;
    }

    /**
     * Sets  the distance matrix request unit system.
     *
     * @param string $unitSystem The distance matrix request unit system.
     *
     * @throws \Ivory\GoogleMap\Exception\DistanceMatrixException If the unit system is not valid.
     */
    public function setUnitSystem($unitSystem = null)
    {
        if (!in_array($unitSystem, UnitSystem::getUnitSystems()) && ($unitSystem !== null)) {
            throw DistanceMatrixException::invalidDistanceMatrixRequestUnitSystem();
        }

        $this->unitSystem = $unitSystem;
    }

    /**
     * Checks if the distance matrix request has a sensor.
     *
     * @return boolean TRUE if the distance matrix request has a sensor else FALSE.
     */
    public function hasSensor()
    {
        return $this->sensor;
    }

    /**
     * Sets the distance matrix request sensor.
     *
     * @param boolean $sensor TRUE if the distance matrix request has a sensor else FALSE.
     *
     * @throws \Ivory\GoogleMap\Exception\DistanceMatrixException If the sensor flag is not valid.
     */
    public function setSensor($sensor)
    {
        if (!is_bool($sensor)) {
            throw DistanceMatrixException::invalidDistanceMatrixRequestSensor();
        }

        $this->sensor = $sensor;
    }

    /**
     * Checks if the distance matrix request is valid.
     *
     * @return boolean TRUE if the distance matrix request is valid else FALSE.
     */
    public function isValid()
    {
        return $this->hasDestinations() && $this->hasOrigins();
    }
}
