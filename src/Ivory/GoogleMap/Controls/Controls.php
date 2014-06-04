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
     * Available prototypes:
     *  - function setMapTypeControl(Ivory\GoogleMap\Controls\MapTypeControl $mapTypeControl = null)
     *  - function setMaptypeControl(array $mapTypeIds, string $controlPosition, string $mapTypeControlStyle)
     *
     * @throws \Ivory\GoogleMap\Exception\ControlException If the map type control is not valid (prototypes).
     */
    public function setMapTypeControl()
    {
        $args = func_get_args();

        if (isset($args[0]) && ($args[0] instanceof MapTypeControl)) {
            $this->mapTypeControl = $args[0];
        } elseif ((isset($args[0]) && is_array($args[0]))
            && (isset($args[1]) && is_string($args[1]))
            && (isset($args[2]) && is_string($args[2]))
        ) {
            if ($this->mapTypeControl === null) {
                $this->mapTypeControl = new MapTypeControl();
            }

            $this->mapTypeControl->setMapTypeIds($args[0]);
            $this->mapTypeControl->setControlPosition($args[1]);
            $this->mapTypeControl->setMapTypeControlStyle($args[2]);
        } elseif (!isset($args[0])) {
            $this->mapTypeControl = null;
        } else {
            throw ControlException::invalidMapTypeControl();
        }
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
     * Available prototypes:
     *  - function setOverviewMapControl(Ivory\GoogleMap\Controls\OverviewMapControl $overviewMapControl = null)
     *  - function setOverviewMapControl(boolean $opened)
     *
     * @throws \Ivory\GoogleMap\Exception\ControlException If the overview map control is not valid (prototypes).
     */
    public function setOverviewMapControl()
    {
        $args = func_get_args();

        if (isset($args[0]) && ($args[0]) instanceof OverviewMapControl) {
            $this->overviewMapControl = $args[0];
        } elseif (isset($args[0]) && is_bool($args[0])) {
            if ($this->overviewMapControl === null) {
                $this->overviewMapControl = new OverviewMapControl();
            }

            $this->overviewMapControl->setOpened($args[0]);
        } elseif (!isset($args[0])) {
            $this->overviewMapControl = null;
        } else {
            throw ControlException::invalidOverviewMapControl();
        }
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
     * Available prototypes:
     *  - function setPanControl(Ivory\GoogleMap\Controls\PanControl $panControl = null)
     *  - function setPanControl(string $controlPosition)
     *
     * @throws \Ivory\GoogleMap\Exception\ControlException If the pan control is not valid (prototypes).
     */
    public function setPanControl()
    {
        $args = func_get_args();

        if (isset($args[0]) && ($args[0] instanceof PanControl)) {
            $this->panControl = $args[0];
        } elseif (isset($args[0]) && is_string($args[0])) {
            if ($this->panControl === null) {
                $this->panControl = new PanControl();
            }

            $this->panControl->setControlPosition($args[0]);
        } elseif (!isset($args[0])) {
            $this->panControl = null;
        } else {
            throw ControlException::invalidPanControl();
        }
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
     * Available prototypes:
     *  - function setRotateControl(Ivory\GoogleMap\Controls\RotateControl $rotateControl = null)
     *  - function setRotateControl(string $controlPosition)
     *
     * @throws \Ivory\GoogleMap\Exception\ControlException If the rotate control is not valid (prototypes).
     */
    public function setRotateControl()
    {
        $args = func_get_args();

        if (isset($args[0]) && ($args[0] instanceof RotateControl)) {
            $this->rotateControl = $args[0];
        } elseif (isset($args[0]) && is_string($args[0])) {
            if ($this->rotateControl === null) {
                $this->rotateControl = new RotateControl();
            }

            $this->rotateControl->setControlPosition($args[0]);
        } elseif (!isset($args[0])) {
            $this->rotateControl = null;
        } else {
            throw ControlException::invalidRotateControl();
        }
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
     * Available prototypes:
     *  - function setScaleControl(Ivory\GoogleMap\Controls\ScaleControl $scaleControl = null)
     *  - function setScaleControl(string $controlPosition, string $scaleControlStyle)
     *
     * @throws \Ivory\GoogleMap\Exception\ControlException If the scale control is not valid (prototypes).
     */
    public function setScaleControl()
    {
        $args = func_get_args();

        if (isset($args[0]) && ($args[0] instanceof ScaleControl)) {
            $this->scaleControl = $args[0];
        } elseif ((isset($args[0]) && is_string($args[0])) && (isset($args[1]) && is_string($args[1]))) {
            if ($this->scaleControl === null) {
                $this->scaleControl = new ScaleControl();
            }

            $this->scaleControl->setControlPosition($args[0]);
            $this->scaleControl->setScaleControlStyle($args[1]);
        } elseif (!isset($args[0])) {
            $this->scaleControl = null;
        } else {
            throw ControlException::invalidScaleControl();
        }
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
     * Available prototypes:
     *  - function setStreetViewControl(Ivory\GoogleMap\Controls\StreetViewControl $streetViewControl = null)
     *  - function setStreetViewControl(string $controlPosition)
     *
     * @throws \Ivory\GoogleMap\Exception\ControlException If the street view control is not valid (prototypes).
     */
    public function setStreetViewControl()
    {
        $args = func_get_args();

        if (isset($args[0]) && ($args[0] instanceof StreetViewControl)) {
            $this->streetViewControl = $args[0];
        } elseif (isset($args[0]) && is_string($args[0])) {
            if ($this->streetViewControl === null) {
                $this->streetViewControl = new StreetViewControl();
            }

            $this->streetViewControl->setControlPosition($args[0]);
        } elseif (!isset($args[0])) {
            $this->streetViewControl = null;
        } else {
            throw ControlException::invalidStreetViewControl();
        }
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
     * Available prototypes:
     *  - function setZoomControl(Ivory\GoogleMap\Controls\ZoomControl $zoomControl = null)
     *  - function setZoomControl(string $controlPosition, string $zoomControlStyle)
     *
     * @throws \Ivory\GoogleMap\Exception\ControlException If the zoom control is not valid (prototypes).
     */
    public function setZoomControl()
    {
        $args = func_get_args();

        if (isset($args[0]) && ($args[0] instanceof ZoomControl)) {
            $this->zoomControl = $args[0];
        } elseif ((isset($args[0]) && is_string($args[0])) && (isset($args[1]) && is_string($args[1]))) {
            if ($this->zoomControl === null) {
                $this->zoomControl = new ZoomControl();
            }

            $this->zoomControl->setControlPosition($args[0]);
            $this->zoomControl->setZoomControlStyle($args[1]);
        } elseif (!isset($args[0])) {
            $this->zoomControl = null;
        } else {
            throw ControlException::invalidZoomControl();
        }
    }
}
