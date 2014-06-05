<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Services\Directions;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Exception\DirectionsException;
use Ivory\GoogleMap\Services\Base\TravelMode;
use Ivory\GoogleMap\Services\Base\UnitSystem;

/**
 * Directions request represents a google map directions request.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#DirectionsRequest
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsRequest
{
    /** @var boolean */
    protected $avoidHighways;

    /** @var boolean */
    protected $avoidTolls;

    /** @var string | \Ivory\GoogleMap\Base\Coordinate */
    protected $destination;

    /** @var boolean */
    protected $optimizeWaypoints;

    /** @var string | \Ivory\GoogleMap\Base\Coordinate */
    protected $origin;

    /** @var \DateTime */
    protected $departureTime;

    /** @var  \DateTime */
    protected $arrivalTime;

    /** @var boolean */
    protected $provideRouteAlternatives;

    /** @var string */
    protected $region;

    /** @var string */
    protected $language;

    /** @var string */
    protected $travelMode;

    /** @var string */
    protected $unitSystem;

    /** @var array */
    protected $waypoints;

    /** @var boolean */
    protected $sensor;

    /**
     * Creates a directions request.
     *
     * @param string|\Ivory\GoogleMap\Base\Coordinate $origin      The origin.
     * @param string|\Ivory\GoogleMap\Base\Coordinate $destination The destination.
     */
    public function __construct($origin, $destination)
    {
        $this->setOrigin($origin);
        $this->setDestination($destination);
        $this->waypoints = array();
        $this->sensor = false;
    }

    /**
     * Checks if the directions request has an avoid hightways flag.
     *
     * @return boolean TRUE if the directions request has an avoid hightways flag else FALSE.
     */
    public function hasAvoidHighways()
    {
        return $this->avoidHighways !== null;
    }

    /**
     * Checks if the directions request avoid hightways.
     *
     * @return boolean TRUE if the directions request avoids hightways else FALSE.
     */
    public function getAvoidHighways()
    {
        return $this->avoidHighways;
    }

    /**
     * Sets if the the directions request avoids hightways.
     *
     * @param boolean $avoidHighways TRUE if the directions request avoids hightways else FALSE.
     *
     * @throws \Ivory\GoogleMap\Exception\DirectionsException If the avoid highways flag is not valid.
     */
    public function setAvoidHighways($avoidHighways = null)
    {
        if (!is_bool($avoidHighways) && ($avoidHighways !== null)) {
            throw DirectionsException::invalidDirectionsRequestAvoidHighways();
        }

        $this->avoidHighways = $avoidHighways;
    }

    /**
     * Checks if the directions request has an avoid tolls flag.
     *
     * @return boolean TRUE if the directions request has an avoid tolls flag else FALSE.
     */
    public function hasAvoidTolls()
    {
        return $this->avoidTolls !== null;
    }

    /**
     * Checks if the directions request avoid tolls.
     *
     * @return boolean TRUE if the directions request avoids tolls else FALSE.
     */
    public function getAvoidTolls()
    {
        return $this->avoidTolls;
    }

    /**
     * Sets if the the directions request avoids tolls.
     *
     * @param boolean $avoidTolls TRUE if the directions request avoids tolls else FALSE.
     *
     * @throws \Ivory\GoogleMap\Exception\DirectionsException If the avoid tolls flag is not valid.
     */
    public function setAvoidTolls($avoidTolls = null)
    {
        if (!is_bool($avoidTolls) && ($avoidTolls !== null)) {
            throw DirectionsException::invalidDirectionsRequestAvoidTolls();
        }

        $this->avoidTolls = $avoidTolls;
    }

    /**
     * Checks if the directions request has a destination.
     *
     * @return boolean TRUE if the directions request has a destination else FALSE.
     */
    public function hasDestination()
    {
        return !empty($this->destination);
    }

    /**
     * Gets the directions request destination.
     *
     * @return string | \Ivory\GoogleMap\Base\Coordinate The directions request destination.
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * Sets the directions request destination.
     *
     * @param string|\Ivory\GoogleMap\Base\Coordinate $destination The destination.
     *
     * @throws \Ivory\GoogleMap\Exception\DirectionsException If the destination is not valid (prototypes).
     */
    public function setDestination($destination)
    {
        if (isset($destination) && (is_string($destination) || $destination instanceof Coordinate)) {
            $this->destination = $destination;
        } else {
            throw DirectionsException::invalidDirectionsRequestDestination();
        }
    }

    /**
     * Checks if the directions request has the optimize waypoints flag.
     *
     * @return boolean TRUE if the directions request has the optimize waypoints flag else FALSE.
     */
    public function hasOptimizeWaypoints()
    {
        return $this->optimizeWaypoints !== null;
    }

    /**
     * Checks if the directions request optimizes waypoints.
     *
     * @return boolean TRUE if the directions request optmizes waypoints else FALSE.
     */
    public function getOptimizeWaypoints()
    {
        return $this->optimizeWaypoints;
    }

    /**
     * Sets if the directions request optimizes waypoints.
     *
     * @param boolean $optimizeWaypoints TRUE if the directions request optimizes waypoints else FALSE.
     *
     * @throws \Ivory\GoogleMap\Exception\DirectionsException If the optimize waypoints flag is not valid.
     */
    public function setOptimizeWaypoints($optimizeWaypoints = null)
    {
        if (!is_bool($optimizeWaypoints) && ($optimizeWaypoints !== null)) {
            throw DirectionsException::invalidDirectionsRequestOptimizeWaypoints();
        }

        $this->optimizeWaypoints = $optimizeWaypoints;
    }

    /**
     * Checks if the directions request has an origin.
     *
     * @return boolean TRUE if the directions request has an origin else FALSE.
     */
    public function hasOrigin()
    {
        return !empty($this->origin);
    }

    /**
     * Gets the directions request origin.
     *
     * @return string | \Ivory\GoogleMap\Base\Coordinate The directions request origin.
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * Sets the directions request origin.
     *
     * @param string|\Ivory\GoogleMap\Base\Coordinate $origin The origin.
     *
     * @throws \Ivory\GoogleMap\Exception\DirectionsException If the origin is not valid (prototypes).
     */
    public function setOrigin($origin)
    {
        if (isset($origin) && (is_string($origin) || $origin instanceof Coordinate)) {
            $this->origin = $origin;
        } else {
            throw DirectionsException::invalidDirectionsRequestOrigin();
        }
    }

    /**
     * Checks if the directions request has a departure time.
     *
     * @return boolean TRUE if the directions request has a departure time else FALSE.
     */
    public function hasDepartureTime()
    {
        return $this->departureTime !== null;
    }

    /**
     * Gets the directions request departure time.
     *
     * @return \DateTime The directions request departure time.
     */
    public function getDepartureTime()
    {
        return $this->departureTime;
    }

    /**
     * Sets the directions departure time
     *
     * @param \DateTime $departureTime The directions departure time.
     */
    public function setDepartureTime(\DateTime $departureTime = null)
    {
        $this->departureTime = $departureTime;
    }

    /**
     * Checks if the directions request has an arrival time.
     *
     * @return boolean TRUE if the directions request has an arrival time else FALSE.
     */
    public function hasArrivalTime()
    {
        return $this->arrivalTime !== null;
    }

    /**
     * Gets the directions request arrival time.
     *
     * @return \DateTime The directions request arrival time.
     */
    public function getArrivalTime()
    {
        return $this->arrivalTime;
    }

    /**
     * Sets the directions arrival time
     *
     * @param \DateTime $arrivalTime The directions arrival time.
     */
    public function  setArrivalTime(\DateTime $arrivalTime = null)
    {
        $this->arrivalTime = $arrivalTime;
    }

    /**
     * Checks if the directions request has a provide route alternatives flag.
     *
     * @return boolean TRUE if the directions request has a provide route alternative flag else FALSE.
     */
    public function hasProvideRouteAlternatives()
    {
        return $this->provideRouteAlternatives !== null;
    }

    /**
     * Checks if the directions request provides route alternatives.
     *
     * @return boolean TRUE if the directions request provides route alternatives else FALSE.
     */
    public function getProvideRouteAlternatives()
    {
        return $this->provideRouteAlternatives;
    }

    /**
     * Sets if the directions request provides route alternatives.
     *
     * @param boolean $provideRouteAlternatives TRUE if the directions request provides route alternatives else FALSE.
     *
     * @throws \Ivory\GoogleMap\Exception\DirectionsException If the provide route alternatives flag is not valid.
     */
    public function setProvideRouteAlternatives($provideRouteAlternatives = null)
    {
        if (!is_bool($provideRouteAlternatives) && ($provideRouteAlternatives !== null)) {
            throw DirectionsException::invalidDirectionsRequestProvideRouteAlternatives();
        }

        $this->provideRouteAlternatives = $provideRouteAlternatives;
    }

    /**
     * Checks if the directions request has a region.
     *
     * @return boolean TRUE if the directions request has a region else FALSE.
     */
    public function hasRegion()
    {
        return $this->region !== null;
    }

    /**
     * Gets the directions request region.
     *
     * @return string The direction request region.
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Sets the directions request region.
     *
     * @param string $region The directions request region.
     *
     * @throws \Ivory\GoogleMap\Exception\DirectionsException If the region is not valid.
     */
    public function setRegion($region = null)
    {
        if ((!is_string($region) || (strlen($region) !== 2)) && ($region !== null)) {
            throw DirectionsException::invalidDirectionsRequestRegion();
        }

        $this->region = $region;
    }

    /**
     * Checks if the directions request has a language.
     *
     * @return boolean TRUE if the directions request has a language else FALSE.
     */
    public function hasLanguage()
    {
        return $this->language !== null;
    }

    /**
     * Gets the directions request language.
     *
     * @return string The direction request language.
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Sets the directions request language.
     *
     * @param string $language The directions request language.
     *
     * @throws \Ivory\GoogleMap\Exception\DirectionsException If the language is not valid.
     */
    public function setLanguage($language = null)
    {
        if ((!is_string($language) || ((strlen($language) !== 2) && (strlen($language) !== 5))) && ($language !== null)) {
            throw DirectionsException::invalidDirectionsRequestLanguage();
        }

        $this->language = $language;
    }

    /**
     * Checks if the directions request has a travel mode.
     *
     * @return boolean TRUE if the directions request has a travel mode else FALSE.
     */
    public function hasTravelMode()
    {
        return $this->travelMode !== null;
    }

    /**
     * Gets the directions request travel mode.
     *
     * @return string The directions request travel mode.
     */
    public function getTravelMode()
    {
        return $this->travelMode;
    }

    /**
     * Sets the directions request travel mode.
     *
     * @param string $travelMode The directions request travel mode.
     *
     * @throws \Ivory\GoogleMap\Exception\DirectionsException If the travel mode is not valid.
     */
    public function setTravelMode($travelMode = null)
    {
        if (!in_array($travelMode, TravelMode::getTravelModes()) && ($travelMode !== null)) {
            throw DirectionsException::invalidDirectionsRequestTravelMode();
        }

        $this->travelMode = $travelMode;
    }

    /**
     * Checks if the directions request has a unit system.
     *
     * @return boolean TRUE if the directions request has a unit system else FALSE.
     */
    public function hasUnitSystem()
    {
        return $this->unitSystem !== null;
    }

    /**
     * Gets the directions request unit system.
     *
     * @return string The directions request unit system.
     */
    public function getUnitSystem()
    {
        return $this->unitSystem;
    }

    /**
     * Sets  the directions request unit system.
     *
     * @param string $unitSystem The directions request unit system.
     *
     * @throws \Ivory\GoogleMap\Exception\DirectionsException If the unit system is not valid.
     */
    public function setUnitSystem($unitSystem = null)
    {
        if (!in_array($unitSystem, UnitSystem::getUnitSystems()) && ($unitSystem !== null)) {
            throw DirectionsException::invalidDirectionsRequestUnitSystem();
        }

        $this->unitSystem = $unitSystem;
    }

    /**
     * Checks if the directions request has waypoints.
     *
     * @return boolean TRUE if the directions request has waypoints else FALSE.
     */
    public function hasWaypoints()
    {
        return !empty($this->waypoints);
    }

    /**
     * Gets the directions request waypoints.
     *
     * @return array The directions request waypoints.
     */
    public function getWaypoints()
    {
        return $this->waypoints;
    }

    /**
     * Sets the directions request waypoints.
     *
     * @param array $waypoints The directions request waypoints.
     */
    public function setWaypoints(array $waypoints = array())
    {
        $this->waypoints = array();

        foreach ($waypoints as $waypoint) {
            $this->addWaypoint($waypoint);
        }
    }

    /**
     * Adds a waypoint to the directions request.
     *
     * @param \Ivory\GoogleMap\Services\Directions\DirectionsWaypoint $waypoint The waypoint.
     */
    public function addWaypoint(DirectionsWaypoint $waypoint)
    {
        $this->waypoints[] = $waypoint;
    }

    /**
     * Checks if the directions request has a sensor.
     *
     * @return boolean TRUE if the directions request has a sensor else FALSE.
     */
    public function hasSensor()
    {
        return $this->sensor;
    }

    /**
     * Sets the directions request sensor.
     *
     * @param boolean $sensor TRUE if the directions request has a sensor else FALSE.
     *
     * @throws \Ivory\GoogleMap\Exception\DirectionsException If the sensor flag is not valid.
     */
    public function setSensor($sensor)
    {
        if (!is_bool($sensor)) {
            throw DirectionsException::invalidDirectionsRequestSensor();
        }

        $this->sensor = $sensor;
    }

    /**
     * Checks if the directions request is valid.
     *
     * @return boolean TRUE if the directions request is valid else FALSE.
     */
    public function isValid()
    {
        $isValid = $this->hasDestination() && $this->hasOrigin();

        for ($i = 0; $isValid && ($i < count($this->waypoints)); $i++) {
            $isValid = $this->waypoints[$i]->isValid();
        }

        if ($this->getTravelMode() === TravelMode::TRANSIT) {
            $isValid = $this->hasArrivalTime() || $this->hasDepartureTime();
        }

        return $isValid;
    }
}
