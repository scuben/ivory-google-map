<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Aggregator\Overlays;

use Ivory\GoogleMap\Helper\Aggregator\AbstractAggregatorHelper;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlays\Marker;

/**
 * Marker shape aggregator helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerShapeAggregatorHelper extends AbstractAggregatorHelper
{
    /**
     * Aggregates the marker shapes of a map.
     *
     * @param \Ivory\GoogleMap\Map $map          The map.
     * @param array                $markerShapes The marker shapes.
     *
     * @return array The aggregated marker shapes.
     */
    public function aggregate(Map $map, array $markerShapes = array())
    {
        return $this->aggregateOverlays($map->getOverlays(), $markerShapes);
    }

    /**
     * Aggregates the marker shapes of the markers.
     *
     * @param \Ivory\GoogleMap\Map $map The map.
     * @param array $markerShapes The marker shapes.
     *
     * @return array The aggregated marker shapes.
     */
    public function aggregateMarkers(Map $map, array $markerShapes = array())
    {
        foreach ($map->getOverlays()->getMarkers() as $marker) {
            $markerShapes = $this->aggregateMarker($marker, $markerShapes);
        }

        return $markerShapes;
    }

    /**
     * Agggregates the marker shape of a marker.
     *
     * @param \Ivory\GoogleMap\Overlays\Marker $marker       The marker.
     * @param array                            $markerShapes The marker shapes.
     *
     * @return array The aggregated marker shapes.
     */
    protected function aggregateMarker(Marker $marker, array $markerShapes = array())
    {
        if ($marker->hasShape()) {
            $markerShapes = $this->aggregateItem($marker->getShape(), $markerShapes);
        }

        return $markerShapes;
    }
}
