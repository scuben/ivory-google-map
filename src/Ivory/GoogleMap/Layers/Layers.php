<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Layers;

use Ivory\GoogleMap\Layers\KMLLayer;

/**
 * Layers which describes a google map layers.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Layers
{
    /** @var array */
    protected $kmlLayers;

    /**
     * Creates a layers.
     */
    public function __construct()
    {
        $this->kmlLayers = array();
    }

    /**
     * Checks if the layers have kml.
     *
     * @return boolean TRUE if the layers have kml else FALSE.
     */
    public function hasKMLLayers()
    {
        return !empty($this->kmlLayers);
    }

    /**
     * Gets the KML layers.
     *
     * @return array The KML layers.
     */
    public function getKMLLayers()
    {
        return $this->kmlLayers;
    }

    /**
     * Adds a KML Layer to the map.
     *
     * @param \Ivory\GoogleMap\Layers\KMLLayer $kmlLayer The KML layer.
     */
    public function addKMLLayer(KMLLayer $kmlLayer)
    {
        $this->kmlLayers[] = $kmlLayer;
    }
}
