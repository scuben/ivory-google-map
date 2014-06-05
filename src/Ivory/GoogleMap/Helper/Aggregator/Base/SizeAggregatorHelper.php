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

use Ivory\GoogleMap\Helper\Aggregator\Overlays\InfoWindowAggregatorHelper;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlays\InfoWindow;
use Ivory\GoogleMap\Overlays\Marker;
use Ivory\GoogleMap\Overlays\MarkerImage;

/**
 * Size aggregator helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class SizeAggregatorHelper extends AbstractAggregatorHelper
{
    /** @var \Ivory\GoogleMap\Helper\Aggregator\Overlays\InfoWindowAggregatorHelper */
    protected $infoWindowAggregatorHelper;

    /**
     * Creates a size aggregator helper.
     *
     * @param \Ivory\GoogleMap\Helper\Aggregator\Overlays\InfoWindowAggregatorHelper $infoWindowAggregatorHelper The info window aggregator helper.
     */
    public function __construct(InfoWindowAggregatorHelper $infoWindowAggregatorHelper = null)
    {
        if ($infoWindowAggregatorHelper === null) {
            $infoWindowAggregatorHelper = new InfoWindowAggregatorHelper();
        }

        $this->setInfoWindowAggregatorHelper($infoWindowAggregatorHelper);
    }

    /**
     * Gets the info window aggregator helper.
     *
     * @return \Ivory\GoogleMap\Helper\Aggregator\Overlays\InfoWindowAggregatorHelper The info window aggregator helper.
     */
    public function getInfoWindowAggregatorHelper()
    {
        return $this->infoWindowAggregatorHelper;
    }

    /**
     * Sets the info window aggregator helper.
     *
     * @param \Ivory\GoogleMap\Helper\Aggregator\Overlays\InfoWindowAggregatorHelper $infoWindowAggregatorHelper The info window aggregator helper.
     */
    public function setInfoWindowAggregatorHelper(InfoWindowAggregatorHelper $infoWindowAggregatorHelper)
    {
        $this->infoWindowAggregatorHelper = $infoWindowAggregatorHelper;
    }

    /**
     * Aggregates the sizes of a map.
     *
     * @param \Ivory\GoogleMap\Map $map   The map.
     * @param array                $sizes The sizes.
     *
     * @return array The aggregated sizes.
     */
    public function aggregate(Map $map, array $sizes = array())
    {
        $sizes = $this->aggregateInfoWindows($map, $sizes);
        $sizes = $this->aggregateMarkers($map, $sizes);

        return $sizes;
    }

    /**
     * Aggregates the sizes of the info windows.
     *
     * @param \Ivory\GoogleMap\Map $map   The map.
     * @param array                $sizes The sizes.
     *
     * @return array The aggregated sizes.
     */
    public function aggregateInfoWindows(Map $map, array $sizes = array())
    {
        foreach ($this->infoWindowAggregatorHelper->aggregate($map) as $infoWindow) {
            $sizes = $this->aggregateInfoWindow($infoWindow, $sizes);
        }

        return $sizes;
    }

    /**
     * Aggregates the sizes of the markers.
     *
     * @param \Ivory\GoogleMap\Map $map   The map.
     * @param array                $sizes The sizes.
     *
     * @return array The aggregated sizes.
     */
    public function aggregateMarkers(Map $map, array $sizes = array())
    {
        foreach ($map->getOverlays()->getMarkers() as $marker) {
            $sizes = $this->aggregateMarker($marker, $sizes);
        }

        return $sizes;
    }

    /**
     * Aggregates the sizes of an info window.
     *
     * @param \Ivory\GoogleMap\Overlays\InfoWindow $infoWindow The info window.
     * @param array                                $sizes      The sizes.
     *
     * @return array The aggregated sizes.
     */
    protected function aggregateInfoWindow(InfoWindow $infoWindow, array $sizes = array())
    {
        if ($infoWindow->hasPixelOffset()) {
            $sizes = $this->aggregateValue($infoWindow->getPixelOffset(), $sizes);
        }

        return $sizes;
    }

    /**
     * Aggregates the sizes of a marker.
     *
     * @param \Ivory\GoogleMap\Overlays\Marker $marker The marker.
     * @param array                            $sizes  The sizes.
     *
     * @return array The aggregated sizes.
     */
    protected function aggregateMarker(Marker $marker, array $sizes = array())
    {
        if ($marker->hasIcon()) {
            $sizes = $this->aggregateMarkerImage($marker->getIcon(), $sizes);
        }

        if ($marker->hasShadow()) {
            $sizes = $this->aggregateMarkerImage($marker->getShadow(), $sizes);
        }

        return $sizes;
    }

    /**
     * Aggregates the sizes of a marker image.
     *
     * @param \Ivory\GoogleMap\Overlays\MarkerImage $markerImage The marker image.
     * @param array                                 $sizes       The sizes.
     *
     * @return array The aggregated sizes.
     */
    protected function aggregateMarkerImage(MarkerImage $markerImage, array $sizes = array())
    {
        if ($markerImage->hasSize()) {
            $sizes = $this->aggregateValue($markerImage->getSize(), $sizes);
        }

        if ($markerImage->hasScaledSize()) {
            $sizes = $this->aggregateValue($markerImage->getScaledSize(), $sizes);
        }

        return $sizes;
    }
}
