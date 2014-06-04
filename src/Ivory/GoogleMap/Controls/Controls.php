<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Controls;

use Ivory\GoogleMap\Controls\MapTypeControl;
use Ivory\GoogleMap\Controls\OverviewMapControl;
use Ivory\GoogleMap\Controls\PanControl;
use Ivory\GoogleMap\Controls\RotateControl;
use Ivory\GoogleMap\Controls\ScaleControl;
use Ivory\GoogleMap\Controls\StreetViewControl;
use Ivory\GoogleMap\Controls\ZoomControl;
use Ivory\GoogleMap\Exception\ControlException;

/**
 * Controls which describes google map controls.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Controls
{
    /** @var \Ivory\GoogleMap\Controls\MapTypeControl */
    protected $mapTypeControl;

    /** @var \Ivory\GoogleMap\Controls\OverviewMapControl */
    protected $overviewMapControl;

    /** @var \Ivory\GoogleMap\Controls\PanControl */
    protected $panControl;

    /** @var \Ivory\GoogleMap\Controls\RotateControl */
    protected $rotateControl;

    /** @var \Ivory\GoogleMap\Controls\ScaleControl */
    protected $scaleControl;

    /** @var \Ivory\GoogleMap\Controls\StreetViewControl */
    protected $streetViewControl;

    /** @var \Ivory\GoogleMap\Controls\ZoomControl */
    protected $zoomControl;

    /**
     * Checks if the map has a map type control.
     *
     * @return boolean TRUE if the map has a map type control else FALSE.
     */
    public function hasMapTypeControl()
    {
        return $this->mapTypeControl !== null;
    }

    /**
     * Gets the map type control.
     *
     * @return \Ivory\GoogleMap\Controls\MapTypeControl The map type control.
     */
    public function getMapTypeControl()
    {
        return $this->mapTypeControl;
    }

    /**
     * Sets the map type control.
     *
     * @param \Ivory\GoogleMap\Controls\MapTypeControl|null $mapTypeControl The map type control.
     */
    public function setMapTypeControl(MapTypeControl $mapTypeControl = null)
    {
        $this->mapTypeControl = $mapTypeControl;
    }

    /**
     * Checks if the map has an overview map control.
     *
     * @return boolean TRUE if the map has an overview map control else FALSE.
     */
    public function hasOverviewMapControl()
    {
        return $this->overviewMapControl !== null;
    }

    /**
     * Gets the overview map control.
     *
     * @return \Ivory\GoogleMap\Controls\OverviewMapControl The overview map control.
     */
    public function getOverviewMapControl()
    {
        return $this->overviewMapControl;
    }

    /**
     * Sets the overview map control.
     *
     * @param \Ivory\GoogleMap\Controls\OverviewMapControl|null $overviewMapControl The overview map control.
     */
    public function setOverviewMapControl(OverviewMapControl $overviewMapControl = null)
    {
        $this->overviewMapControl = $overviewMapControl;
    }

    /**
     * Checks if the map has a pan control.
     *
     * @return boolean TRUE if the map has a pan control else FALSE.
     */
    public function hasPanControl()
    {
        return $this->panControl !== null;
    }

    /**
     * Gets the map pan control.
     *
     * @return \Ivory\GoogleMap\Controls\PanControl The map pan control.
     */
    public function getPanControl()
    {
        return $this->panControl;
    }

    /**
     * Sets the map pan control.
     *
     * @param \Ivory\GoogleMap\Controls\PanControl|null $panControl The map pan control.
     */
    public function setPanControl(PanControl $panControl = null)
    {
        $this->panControl = $panControl;
    }

    /**
     * Checks if the map has a rotate control.
     *
     * @return boolean TRUE if the map has a rotate control else FALSE.
     */
    public function hasRotateControl()
    {
        return $this->rotateControl !== null;
    }

    /**
     * Gets the map rotate control.
     *
     * @return \Ivory\GoogleMap\Controls\RotateControl The map rotate control.
     */
    public function getRotateControl()
    {
        return $this->rotateControl;
    }

    /**
     * Sets the map rotate control.
     *
     * @param \Ivory\GoogleMap\Controls\RotateControl|null $rotateControl The rotate control.
     */
    public function setRotateControl(RotateControl $rotateControl = null)
    {
        $this->rotateControl = $rotateControl;
    }

    /**
     * Checks if the map has a scale control else FALSE.
     *
     * @return boolean TRUE if the map has a scale control else FALSE.
     */
    public function hasScaleControl()
    {
        return $this->scaleControl !== null;
    }

    /**
     * Gets the map scale control.
     *
     * @return \Ivory\GoogleMap\Controls\ScaleControl The map scale control.
     */
    public function getScaleControl()
    {
        return $this->scaleControl;
    }

    /**
     * Sets the map scale control.
     *
     * @param \Ivory\GoogleMap\Controls\ScaleControl|null $scaleControl The map scale control.
     */
    public function setScaleControl(ScaleControl $scaleControl = null)
    {
        $this->scaleControl = $scaleControl;
    }

    /**
     * Checks if the map has a street view control.
     *
     * @return boolean TRUE if the map has a street view control else FALSE.
     */
    public function hasStreetViewControl()
    {
        return $this->streetViewControl !== null;
    }

    /**
     * Gets the map street view control.
     *
     * @return \Ivory\GoogleMap\Controls\StreetViewControl The map street view control.
     */
    public function getStreetViewControl()
    {
        return $this->streetViewControl;
    }

    /**
     * Sets the map street view control.
     *
     * @param \Ivory\GoogleMap\Controls\StreetViewControl|null $streetViewControl The map street view control.
     */
    public function setStreetViewControl(StreetViewControl $streetViewControl = null)
    {
        $this->streetViewControl = $streetViewControl;
    }

    /**
     * Checks if the map has a zoom control.
     *
     * @return boolean TRUE if the map has a zoom control else FALSE.
     */
    public function hasZoomControl()
    {
        return $this->zoomControl !== null;
    }

    /**
     * Gets the map zoom control.
     *
     * @return \Ivory\GoogleMap\Controls\ZoomControl The map zoom control.
     */
    public function getZoomControl()
    {
        return $this->zoomControl;
    }

    /**
     * Sets the map zoom control.
     *
     * @param \Ivory\GoogleMap\Controls\ZoomControl|null $zoomControl The map zoom control.
     */
    public function setZoomControl(ZoomControl $zoomControl = null)
    {
        $this->zoomControl = $zoomControl;
    }
}
