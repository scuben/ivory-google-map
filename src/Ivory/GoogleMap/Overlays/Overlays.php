<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Overlays;

use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlays\Circle;
use Ivory\GoogleMap\Overlays\EncodedPolyline;
use Ivory\GoogleMap\Overlays\GroundOverlay;
use Ivory\GoogleMap\Overlays\InfoWindow;
use Ivory\GoogleMap\Overlays\Marker;
use Ivory\GoogleMap\Overlays\MarkerCluster;
use Ivory\GoogleMap\Overlays\Polygon;
use Ivory\GoogleMap\Overlays\Polyline;
use Ivory\GoogleMap\Overlays\Rectangle;

/**
 * Overlays which describes google map overlays.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Overlays
{
    /** @var \Ivory\GoogleMap\Map */
    protected $map;

    /** @var \Ivory\GoogleMap\Overlays\MarkerCluster */
    protected $markerCluster;

    /** @var array */
    protected $infoWindows;

    /** @var array */
    protected $polylines;

    /** @var array */
    protected $encodedPolylines;

    /** @var array */
    protected $polygons;

    /** @var array */
    protected $rectangles;

    /** @var array */
    protected $circles;

    /** @var array */
    protected $groundOverlays;

    /**
     * Creates an overlays.
     */
    public function __construct(Map $map)
    {
        $this->setMap($map);
        $this->markerCluster = new MarkerCluster();

        $this->infoWindows = array();
        $this->polylines = array();
        $this->encodedPolylines = array();
        $this->polygons = array();
        $this->rectangles = array();
        $this->circles = array();
        $this->groundOverlays = array();
    }

    /**
     * Gets the overlays map.
     *
     * @return \Ivory\GoogleMap\Map The overlays map.
     */
    public function getMap()
    {
        return $this->map;
    }

    /**
     * Sets the overlays map.
     *
     * @param \Ivory\GoogleMap\Map $map The overlays map.
     */
    public function setMap(Map $map)
    {
        $this->map = $map;

        if ($map->getOverlays() !== $this) {
            $map->setOverlays($this);
        }
    }

    /**
     * Gets the marker cluster.
     *
     * @return \Ivory\GoogleMap\Overlays\MarkerCluster The marker cluster.
     */
    public function getMarkerCluster()
    {
        return $this->markerCluster;
    }

    /**
     * Sets the marker cluster.
     *
     * @param \Ivory\GoogleMap\Overlays\MarkerCluster $markerCluster The marker cluster.
     */
    public function setMarkerCluster(MarkerCluster $markerCluster)
    {
        $this->markerCluster = $markerCluster;
    }

    /**
     * Checks if the map has markers.
     *
     * @return boolean TRUE if the map has markers else FALSE.
     */
    public function hasMarkers()
    {
        return $this->getMarkerCluster()->hasMarkers();
    }

    /**
     * Gets the map markers.
     *
     * @return array The map markers.
     */
    public function getMarkers()
    {
        return $this->getMarkerCluster()->getMarkers();
    }

    /**
     * Add a map marker.
     *
     * @param \Ivory\GoogleMap\Overlays\Marker $marker The marker to add.
     */
    public function addMarker(Marker $marker)
    {
        $this->getMarkerCluster()->addMarker($marker);

        if ($this->getMap()->isAutoZoom()) {
            $this->getMap()->getBound()->extend($marker);
        }
    }

    /**
     * Checks if the map has info windows.
     *
     * @return boolean TRUE if the map has info windows else FALSE.
     */
    public function hasInfoWindows()
    {
        return !empty($this->infoWindows);
    }

    /**
     * Gets the map info windows.
     *
     * @return array The map info windows.
     */
    public function getInfoWindows()
    {
        return $this->infoWindows;
    }

    /**
     * Add a map info window.
     *
     * @param \Ivory\GoogleMap\Overlays\InfoWindow $infoWindow The info window to add.
     */
    public function addInfoWindow(InfoWindow $infoWindow)
    {
        $this->infoWindows[] = $infoWindow;

        if ($this->getMap()->isAutoZoom()) {
            $this->getMap()->getBound()->extend($infoWindow);
        }
    }

    /**
     * Checks if the map has polylines.
     *
     * @return boolean TRUE if the map has polylines else FALSE.
     */
    public function hasPolylines()
    {
        return !empty($this->polylines);
    }

    /**
     * Gets the map polylines.
     *
     * @return array The map polylines.
     */
    public function getPolylines()
    {
        return $this->polylines;
    }

    /**
     * Add a map polyline.
     *
     * @param \Ivory\GoogleMap\Overlays\Polyline The polyline to add.
     */
    public function addPolyline(Polyline $polyline)
    {
        $this->polylines[] = $polyline;

        if ($this->getMap()->isAutoZoom()) {
            $this->getMap()->getBound()->extend($polyline);
        }
    }

    /**
     * Checks if the map has encoded polylines.
     *
     * @return boolean TRUE if the map has encoded polylines else FALSE.
     */
    public function hasEncodedPolylines()
    {
        return !empty($this->encodedPolylines);
    }

    /**
     * Gets the map encoded polylines.
     *
     * @return array The map encoded polylines.
     */
    public function getEncodedPolylines()
    {
        return $this->encodedPolylines;
    }

    /**
     * Adds an encoded polyline to the map.
     *
     * @param \Ivory\GoogleMap\Overlays\EncodedPolyline $encodedPolyline The encoded polyline to add.
     */
    public function addEncodedPolyline(EncodedPolyline $encodedPolyline)
    {
        $this->encodedPolylines[] = $encodedPolyline;

        if ($this->getMap()->isAutoZoom()) {
            $this->getMap()->getBound()->extend($encodedPolyline);
        }
    }

    /**
     * Checks if the map has polygons.
     *
     * @return boolean TRUE if the map has polygons else FALSE.
     */
    public function hasPolygons()
    {
        return !empty($this->polygons);
    }

    /**
     * Gets the map polygons.
     *
     * @return array The map polygons.
     */
    public function getPolygons()
    {
        return $this->polygons;
    }

    /**
     * Add a map polygon.
     *
     * @param \Ivory\GoogleMap\Overlays\Polygon $polygon The polygon to add.
     */
    public function addPolygon(Polygon $polygon)
    {
        $this->polygons[] = $polygon;

        if ($this->getMap()->isAutoZoom()) {
            $this->getMap()->getBound()->extend($polygon);
        }
    }

    /**
     * Checks if the map has rectangles.
     *
     * @return boolean TRUE if the map has rectangles else FALSE.
     */
    public function hasRectangles()
    {
        return !empty($this->rectangles);
    }

    /**
     * Gets the map rectangles.
     *
     * @return array The map rectangles.
     */
    public function getRectangles()
    {
        return $this->rectangles;
    }

    /**
     * Add a map rectangle to the map.
     *
     * @param \Ivory\GoogleMap\Overlays\Rectangle $rectangle The rectangle to add.
     */
    public function addRectangle(Rectangle $rectangle)
    {
        $this->rectangles[] = $rectangle;

        if ($this->getMap()->isAutoZoom()) {
            $this->getMap()->getBound()->extend($rectangle);
        }
    }

    /**
     * Checks if the map has circles.
     *
     * @return boolean TRUE if the map has circles else FALSE.
     */
    public function hasCircles()
    {
        return !empty($this->circles);
    }

    /**
     * Gets the map circles
     *
     * @return array The map circles.
     */
    public function getCircles()
    {
        return $this->circles;
    }

    /**
     * Add a circle to the map.
     *
     * @param \Ivory\GoogleMap\Overlays\Circle $circle The circle to add.
     */
    public function addCircle(Circle $circle)
    {
        $this->circles[] = $circle;

        if ($this->getMap()->isAutoZoom()) {
            $this->getMap()->getBound()->extend($circle);
        }
    }

    /**
     * Checks if the map has ground overlays.
     *
     * @return boolean TRUE if the map has ground overlays else FALSE.
     */
    public function hasGroundOverlays()
    {
        return !empty($this->groundOverlays);
    }

    /**
     * Gets the map ground overlays.
     *
     * @return array The map ground overlays.
     */
    public function getGroundOverlays()
    {
        return $this->groundOverlays;
    }

    /**
     * Add a ground overlay to the map.
     *
     * @param \Ivory\GoogleMapBundle\Model\Overlays\GroupOverlay $groundOverlay The ground overlay to add.
     */
    public function addGroundOverlay(GroundOverlay $groundOverlay)
    {
        $this->groundOverlays[] = $groundOverlay;

        if ($this->getMap()->isAutoZoom()) {
            $this->getMap()->getBound()->extend($groundOverlay);
        }
    }
}
