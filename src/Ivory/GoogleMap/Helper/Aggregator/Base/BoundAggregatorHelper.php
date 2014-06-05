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

use Ivory\GoogleMap\Helper\Aggregator\AbstractAggregatorHelper;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlays\GroundOverlay;
use Ivory\GoogleMap\Overlays\Rectangle;

/**
 * Bound aggregator helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class BoundAggregatorHelper extends AbstractAggregatorHelper
{
    /**
     * Aggregates the bounds of a map.
     *
     * @param \Ivory\GoogleMap\Map $map    The map.
     * @param array                $bounds The bounds.
     *
     * @return array The aggregated bounds.
     */
    public function aggregate(Map $map, array $bounds = array())
    {
        if ($map->isAutoZoom()) {
            $bounds = $this->aggregateValue($map->getBound(), $bounds);
        }

        $bounds = $this->aggregateGroundOverlays($map, $bounds);
        $bounds = $this->aggregateRectangles($map, $bounds);

        return $bounds;
    }

    /**
     * Aggregates the bounds of the ground overlays.
     *
     * @param \Ivory\GoogleMap\Map $map    The map.
     * @param array                $bounds The bounds.
     *
     * @return array The aggregated bounds.
     */
    public function aggregateGroundOverlays(Map $map, array $bounds = array())
    {
        foreach ($map->getOverlays()->getGroundOverlays() as $groundOverlay) {
            $bounds = $this->aggregateGroundOverlay($groundOverlay, $bounds);
        }

        return $bounds;
    }

    /**
     * Aggregates the bounds of the rectangles.
     *
     * @param \Ivory\GoogleMap\Map $map    The map.
     * @param array                $bounds The bounds.
     *
     * @return array The aggregated bounds.
     */
    public function aggregateRectangles(Map $map, array $bounds = array())
    {
        foreach ($map->getOverlays()->getRectangles() as $rectangle) {
            $bounds = $this->aggregateRectangle($rectangle, $bounds);
        }

        return $bounds;
    }

    /**
     * Aggregates the bound of a ground overlay.
     *
     * @param \Ivory\GoogleMap\Overlays\GroundOverlay $groundOverlay The ground overlay.
     * @param array                                   $bounds        The bounds.
     *
     * @return array The aggregated bounds.
     */
    protected function aggregateGroundOverlay(GroundOverlay $groundOverlay, array $bounds = array())
    {
        return $this->aggregateValue($groundOverlay->getBound(), $bounds);
    }

    /**
     * Aggregates the bound of a rectangle.
     *
     * @param \Ivory\GoogleMap\Overlays\Rectangle $rectangle The rectangle.
     * @param array                               $bounds    The bounds.
     *
     * @return array The aggregated bounds.
     */
    protected function aggregateRectangle(Rectangle $rectangle, array $bounds = array())
    {
        return $this->aggregateValue($rectangle->getBound(), $bounds);
    }
}
