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
 * Marker image aggregator helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerImageAggregatorHelper extends AbstractAggregatorHelper
{
    /**
     * Aggregates the marker images of a map.
     *
     * @param \Ivory\GoogleMap\Map $map          The map.
     * @param array                $markerImages The marker images.
     *
     * @return array The aggregated marker images.
     */
    public function aggregate(Map $map, array $markerImages = array())
    {
        return $this->aggregateMarkers($map, $markerImages);
    }

    /**
     * Aggregates the marker images of the markers.
     *
     * @param \Ivory\GoogleMap\Map $map          The map.
     * @param array                $markerImages The marker images.
     *
     * @return array The aggregated marker images.
     */
    public function aggregateMarkers(Map $map, array $markerImages = array())
    {
        foreach ($map->getOverlays()->getMarkers() as $marker) {
            $markerImages = $this->aggregateMarker($marker, $markerImages);
        }

        return $markerImages;
    }

    /**
     * Aggregates the marker images of a marker.
     *
     * @param \Ivory\GoogleMap\Overlays\Marker $marker       The marker.
     * @param array                            $markerImages The marker images.
     *
     * @return array The aggregated marker images.
     */
    protected function aggregateMarker(Marker $marker, array $markerImages = array())
    {
        if ($marker->hasIcon()) {
            $markerImages = $this->aggregateValue($marker->getIcon(), $markerImages);
        }

        if ($marker->hasShadow()) {
            $markerImages = $this->aggregateValue($marker->getShadow(), $markerImages);
        }

        return $markerImages;
    }
}
