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
 * Info window aggregator helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class InfoWindowAggregatorHelper extends AbstractAggregatorHelper
{
    /**
     * Aggregates the info windows of a map.
     *
     * @param \Ivory\GoogleMap\Map $map         The map.
     * @param array                $infoWindows The info windows.
     *
     * @return array The aggregated info windows.
     */
    public function aggregate(Map $map, array $infoWindows = array())
    {
        $infoWindows = $this->aggregateInfoWindows($map, $infoWindows);
        $infoWindows = $this->aggregateMarkers($map, $infoWindows);

        return $infoWindows;
    }

    /**
     * Aggregates the info windows of the info windows.
     *
     * @param \Ivory\GoogleMap\Map $map         The map.
     * @param array                $infoWindows The info windows.
     *
     * @return array The aggregated info windows.
     */
    public function aggregateInfoWindows(Map $map, array $infoWindows = array())
    {
        return $this->aggregateValues($map->getOverlays()->getInfoWindows(), $infoWindows);
    }

    /**
     * Aggregates the info windows of the markers.
     *
     * @param \Ivory\GoogleMap\Map $map         The map.
     * @param array                $infoWindows The info windows.
     *
     * @return array The aggregated info windows.
     */
    public function aggregateMarkers(Map $map, array $infoWindows = array())
    {
        foreach ($map->getOverlays()->getMarkers() as $marker) {
            $infoWindows = $this->aggregateMarker($marker, $infoWindows);
        }

        return $infoWindows;
    }

    /**
     * Aggregates the info windows of a marker.
     *
     * @param \Ivory\GoogleMap\Overlays\Marker $marker      The marker.
     * @param array                            $infoWindows The info windows.
     *
     * @return array The aggregated info windows.
     */
    protected function aggregateMarker(Marker $marker, array $infoWindows = array())
    {
        if ($marker->hasInfoWindow()) {
            $infoWindows = $this->aggregateValue($marker->getInfoWindow(), $infoWindows);
        }

        return $infoWindows;
    }
}
