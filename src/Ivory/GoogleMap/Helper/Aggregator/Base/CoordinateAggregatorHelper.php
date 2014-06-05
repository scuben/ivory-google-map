<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Aggregator\Base;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Helper\Aggregator\AbstractAggregatorHelper;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlays\Circle;
use Ivory\GoogleMap\Overlays\InfoWindow;
use Ivory\GoogleMap\Overlays\Marker;
use Ivory\GoogleMap\Overlays\Polygon;
use Ivory\GoogleMap\Overlays\Polyline;

/**
 * Coordinate aggregator helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class CoordinateAggregatorHelper extends AbstractAggregatorHelper
{
    /** @var \Ivory\GoogleMap\Helper\Aggregator\Base\BoundAggregatorHelper */
    protected $boundAggregatorHelper;

    /**
     * Creates a coordinate aggregator helper.
     *
     * @param \Ivory\GoogleMap\Helper\Aggregator\Base\BoundAggregatorHelper|null $boundAggregatorHelper The bound aggregator helper.
     */
    public function __construct(BoundAggregatorHelper $boundAggregatorHelper = null)
    {
        if ($boundAggregatorHelper === null) {
            $boundAggregatorHelper = new BoundAggregatorHelper();
        }

        $this->setBoundAggregatorHelper($boundAggregatorHelper);
    }

    /**
     * Gets the bound aggregator helper.
     *
     * @return \Ivory\GoogleMap\Helper\Aggregator\Base\BoundAggregatorHelper The bound aggregator helper.
     */
    public function getBoundAggregatorHelper()
    {
        return $this->boundAggregatorHelper;
    }

    /**
     * Sets the bound aggregator helper.
     *
     * @param \Ivory\GoogleMap\Helper\Aggregator\Base\BoundAggregatorHelper $boundAggregatorHelper The bound aggregator helper.
     */
    public function setBoundAggregatorHelper(BoundAggregatorHelper $boundAggregatorHelper)
    {
        $this->boundAggregatorHelper = $boundAggregatorHelper;
    }

    /**
     * Aggregates the coordinates of a map.
     *
     * @param \Ivory\GoogleMap\Map $map         The map.
     * @param array                $coordinates The coordinates.
     *
     * @return array The aggregated coordinates.
     */
    public function aggregate(Map $map, array $coordinates = array())
    {
        if (!$map->isAutoZoom()) {
            $coordinates = $this->aggregateValue($map->getCenter(), $coordinates);
        }

        $coordinates = $this->aggregateBounds($map, $coordinates);
        $coordinates = $this->aggregateCircles($map, $coordinates);
        $coordinates = $this->aggregateInfoWindows($map, $coordinates);
        $coordinates = $this->aggregateMarkers($map, $coordinates);
        $coordinates = $this->aggregatePolygons($map, $coordinates);
        $coordinates = $this->aggregatePolylines($map, $coordinates);

        return $coordinates;
    }

    /**
     * Aggregates the coordinates of the bounds.
     *
     * @param \Ivory\GoogleMap\Map $map         The map.
     * @param array                $coordinates The coordinates.
     *
     * @return array The aggregated coordinates.
     */
    public function aggregateBounds(Map $map, array $coordinates = array())
    {
        foreach ($this->boundAggregatorHelper->aggregate($map) as $bound) {
            $coordinates = $this->aggregateBound($bound, $coordinates);
        }

        return $coordinates;
    }

    /**
     * Aggregates the coordinates of the circles.
     *
     * @param \Ivory\GoogleMap\Map $map         The map.
     * @param array                $coordinates The coordinates.
     *
     * @return array The aggregated coordinates.
     */
    public function aggregateCircles(Map $map, array $coordinates = array())
    {
        foreach ($map->getOverlays()->getCircles() as $circle) {
            $coordinates = $this->aggregateCircle($circle, $coordinates);
        }

        return $coordinates;
    }

    /**
     * Aggregates the coordinates of the info windows.
     *
     * @param \Ivory\GoogleMap\Map $map         The map.
     * @param array                $coordinates The coordinates.
     *
     * @return array The aggregated coordinates.
     */
    public function aggregateInfoWindows(Map $map, array $coordinates = array())
    {
        foreach ($map->getOverlays()->getInfoWindows() as $infoWindow) {
            $coordinates = $this->aggregateInfoWindow($infoWindow, $coordinates);
        }

        return $coordinates;
    }

    /**
     * Aggregates the coordinates of the markers.
     *
     * @param \Ivory\GoogleMap\Map $map         The map.
     * @param array                $coordinates The coordinates.
     *
     * @return array The aggregated coordinates.
     */
    public function aggregateMarkers(Map $map, array $coordinates = array())
    {
        foreach ($map->getOverlays()->getMarkers() as $marker) {
            $coordinates = $this->aggregateMarker($marker, $coordinates);
        }

        return $coordinates;
    }

    /**
     * Aggregates the coordinates of polygons.
     *
     * @param \Ivory\GoogleMap\Map $map         The map.
     * @param array                $coordinates The coordinates.
     *
     * @return array The aggregated coordinates.
     */
    public function aggregatePolygons(Map $map, array $coordinates = array())
    {
        foreach ($map->getOverlays()->getPolygons() as $polygon) {
            $coordinates = $this->aggregatePolygon($polygon, $coordinates);
        }

        return $coordinates;
    }

    /**
     * Aggregates the coordinates of polylines.
     *
     * @param \Ivory\GoogleMap\Map $map         The map.
     * @param array                $coordinates The coordinates.
     *
     * @return array The aggregated coordinates.
     */
    public function aggregatePolylines(Map $map, array $coordinates = array())
    {
        foreach ($map->getOverlays()->getPolylines() as $polyline) {
            $coordinates = $this->aggregatePolyline($polyline, $coordinates);
        }

        return $coordinates;
    }

    /**
     * Aggregates the coordinates of a bound.
     *
     * @param \Ivory\GoogleMap\Base\Bound $bound       The bound.
     * @param array                       $coordinates The coordinates.
     *
     * @return array The aggregated coordinates.
     */
    protected function aggregateBound(Bound $bound, array $coordinates = array())
    {
        if (!$bound->hasExtends() && $bound->hasCoordinates()) {
            $coordinates = $this->aggregateValue($bound->getSouthWest(), $coordinates);
            $coordinates = $this->aggregateValue($bound->getNorthEast(), $coordinates);
        }

        return $coordinates;
    }

    /**
     * Aggregates the coordinate of a circle.
     *
     * @param \Ivory\GoogleMap\Overlays\Circle $circle      The circle.
     * @param array                            $coordinates The coordinates.
     *
     * @return array The aggregated circles.
     */
    protected function aggregateCircle(Circle $circle, array $coordinates = array())
    {
        return $this->aggregateValue($circle->getCenter(), $coordinates);
    }

    /**
     * Aggregates the coordinates of an info window.
     *
     * @param \Ivory\GoogleMap\Overlays\InfoWindow $infoWindow  The info window.
     * @param array                                $coordinates The coordinates.
     *
     * @return array The aggregated info windows.
     */
    protected function aggregateInfoWindow(InfoWindow $infoWindow, array $coordinates = array())
    {
        return $this->aggregateValue($infoWindow->getPosition(), $coordinates);
    }

    /**
     * Aggregates the coordinates of a marker.
     *
     * @param \Ivory\GoogleMap\Overlays\Marker $marker      The marker.
     * @param array                            $coordinates The coordinates.
     *
     * @return array The aggregated coordinates.
     */
    protected function aggregateMarker(Marker $marker, array $coordinates = array())
    {
        return $this->aggregateValue($marker->getPosition(), $coordinates);
    }

    /**
     * Aggregates the coordinates of a polygon.
     *
     * @param \Ivory\GoogleMap\Overlays\Polygon $polygon     The polygon.
     * @param array                             $coordinates The coordinates.
     *
     * @return array The aggregated coordinates.
     */
    protected function aggregatePolygon(Polygon $polygon, array $coordinates = array())
    {
        foreach ($polygon->getCoordinates() as $coordinate) {
            $coordinates = $this->aggregateValue($coordinate, $coordinates);
        }

        return $coordinates;
    }

    /**
     * Aggregates the coordinates of a polyline.
     *
     * @param \Ivory\GoogleMap\Overlays\Polyline $polyline    The polyline.
     * @param array                              $coordinates The coordinates.
     *
     * @return array The aggregated coordinates.
     */
    protected function aggregatePolyline(Polyline $polyline, array $coordinates = array())
    {
        foreach ($polyline->getCoordinates() as $coordinate) {
            $coordinates = $this->aggregateValue($coordinate, $coordinates);
        }

        return $coordinates;
    }
}
