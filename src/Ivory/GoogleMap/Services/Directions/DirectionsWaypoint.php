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

/**
 * A directions waypoint which describes the google map directions waypoint.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#DirectionsWaypoint
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsWaypoint
{
    /** @var string | \Ivory\GoogleMap\Base\Coordinate */
    protected $location;

    /** @var boolean */
    protected $stopover;

    /**
     * Creates a direction waypoint
     *
     * @param string|\Ivory\GoogleMap\Base\Coordinate $location The coordinate.
     * @param boolean                                 $stopover TRUE if stopover the waypoint, else FALSE.
     */
    public function __construct($location, $stopover = false)
    {
        $this->setLocation($location);
        $this->setStopover($stopover);
    }

    /**
     * Checks if the directions waypoint has a location.
     *
     * @return boolean TRUE if the directions waypoint has a location else FALSE.
     */
    public function hasLocation()
    {
        return !empty($this->location);
    }

    /**
     * Gets the directions waypoint location.
     *
     * @return string | \Ivory\GoogleMap\Base\Coordinate The directions waypoint location.
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Sets the directions waypoint location.
     *
     * @param string|\Ivory\GoogleMap\Base\Coordinate $location The location.
     *
     * @throws \Ivory\GoogleMap\Exception\DirectionsException If the argument is invalid.
     */
    public function setLocation($location)
    {
        if (isset($location) && (is_string($location) || $location instanceof Coordinate)) {
            $this->location = $location;
        } else {
            throw DirectionsException::invalidDirectionsWaypointLocation();
        }
    }

    /**
     * Checks if the directions waypoint has a stopover flag.
     *
     * @return boolean TRUE if the directions waypoint has a stopover flag else FALSE.
     */
    public function hasStopover()
    {
        return $this->stopover === true;
    }

    /**
     * Gets the directions waypoint stopover flag.
     *
     * @return boolean The directions waypoint stopover flag.
     */
    public function getStopover()
    {
        return $this->stopover;
    }

    /**
     * Sets the directions waypoint stopover flag.
     *
     * @param boolean $stopover The directions waypoint stopover flag.
     */
    public function setStopover($stopover = null)
    {
        if (!is_bool($stopover) && ($stopover !== null)) {
            throw DirectionsException::invalidDirectionsWaypointStopover();
        }

        $this->stopover = $stopover;
    }

    /**
     * Checks if the directions waypoint is valid.
     *
     * @return boolean TRUE if the directions waypoint is valid else FALSE.
     */
    public function isValid()
    {
        return $this->hasLocation();
    }
}
