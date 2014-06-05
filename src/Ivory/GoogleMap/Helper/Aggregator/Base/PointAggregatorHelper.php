<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Aggregator;

use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlays\Marker;
use Ivory\GoogleMap\Overlays\MarkerImage;

/**
 * Point aggregator helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PointAggregatorHelper extends AbstractAggregatorHelper
{
    /**
     * Aggregates the points of a map.
     *
     * @param \Ivory\GoogleMap\Map $map    The map.
     * @param array                $points The points.
     *
     * @return array The aggregated points.
     */
    public function aggregate(Map $map, array $points = array())
    {
        return $this->aggregateMarkers($map, $points);
    }


    /**
     * Aggregates the points of markers.
     *
     * @param \Ivory\GoogleMap\Map $map    The map.
     * @param array                $points The points.
     *
     * @return array The aggregated points.
     */
    public function aggregateMarkers(Map $map, array $points = array())
    {
        foreach ($map->getOverlays()->getMarkers() as $marker) {
            $points = $this->aggregateMarker($marker, $points);
        }

        return $points;
    }

    /**
     * Aggregates the points of a marker.
     *
     * @param \Ivory\GoogleMap\Overlays\Marker $marker The marker.
     * @param array                            $points The points.
     *
     * @return array The aggregated points.
     */
    protected function aggregateMarker(Marker $marker, array $points = array())
    {
        if ($marker->hasIcon()) {
            $points = $this->aggregateMarkerImage($marker->getIcon(), $points);
        }

        if ($marker->hasShadow()) {
            $points = $this->aggregateMarkerImage($marker->getShadow(), $points);
        }

        return $points;
    }

    /**
     * Aggregates the points of a marker image.
     *
     * @param \Ivory\GoogleMap\Overlays\MarkerImage $markerImage The marker image.
     * @param array                                 $points      The points.
     *
     * @return array The aggregated points.
     */
    protected function aggregateMarkerImage(MarkerImage $markerImage, array $points = array())
    {
        if ($markerImage->hasAnchor()) {
            $points = $this->aggregateValue($markerImage->getAnchor(), $points);
        }

        if ($markerImage->hasOrigin()) {
            $points = $this->aggregateValue($markerImage->getOrigin(), $points);
        }

        return $points;
    }
}
