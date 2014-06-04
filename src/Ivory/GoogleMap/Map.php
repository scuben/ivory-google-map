<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap;

use Ivory\GoogleMap\Assets\AbstractJavascriptVariableAsset;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Controls\Controls;
use Ivory\GoogleMap\Events\Events;
use Ivory\GoogleMap\Exception\MapException;
use Ivory\GoogleMap\Layers\Layers;
use Ivory\GoogleMap\Overlays\Overlays;

/**
 * Map wich describes a google map.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Map
 * @author GeLo <geloen.eric@gmail.com>
 */
class Map extends AbstractJavascriptVariableAsset
{
    /** @var string */
    protected $htmlContainerId;

    /** @var boolean */
    protected $async;

    /** @var boolean */
    protected $autoZoom;

    /** @var \Ivory\GoogleMap\Base\Coordinate */
    protected $center;

    /** @var \Ivory\GoogleMap\Base\Bound */
    protected $bound;

    /** @var array */
    protected $mapOptions;

    /** @var array */
    protected $stylesheetOptions;

    /** @var \Ivory\GoogleMap\Controls\Controls */
    protected $controls;

    /** @var \Ivory\GoogleMap\Overlays\Overlays */
    protected $overlays;

    /** @var \Ivory\GoogleMap\Layers\Layers */
    protected $layers;

    /** @var \Ivory\GoogleMap\Events\Events */
    protected $events;

    /** @var array */
    protected $libraries;

    /** @var string */
    protected $language;

    /**
     * Creates a map.
     */
    public function __construct()
    {
        $this->setPrefixJavascriptVariable('map_');

        $this->htmlContainerId = 'map_canvas';
        $this->async = false;
        $this->autoZoom = false;

        $this->center = new Coordinate();
        $this->bound = new Bound();

        $this->mapOptions = array(
            'mapTypeId' => MapTypeId::ROADMAP,
            'zoom'      => 3,
        );

        $this->stylesheetOptions = array(
            'width'  => '300px',
            'height' => '300px',
        );

        $this->controls = new Controls();
        $this->overlays = new Overlays($this);
        $this->layers = new Layers();
        $this->events = new Events();

        $this->libraries = array();
        $this->language = 'en';
    }

    /**
     * Gets the map HTML container ID.
     *
     * @return string The map HTML constainer ID.
     */
    public function getHtmlContainerId()
    {
        return $this->htmlContainerId;
    }

    /**
     * Sets the map HTML container ID.
     *
     * @param string $htmlContainerId The map HTML container ID.
     *
     * @throws \Ivory\GoogleMap\Exception\MapException If the HTML container ID is not a string.
     */
    public function setHtmlContainerId($htmlContainerId)
    {
        if (!is_string($htmlContainerId)) {
            throw MapException::invalidHtmlContainerId();
        }

        $this->htmlContainerId = $htmlContainerId;
    }

    /**
     * Check if the map loading is asynchronous.
     *
     * @return boolean TRUE if the map loading is asynchronous else FALSE.
     */
    public function isAsync()
    {
        return $this->async;
    }

    /**
     * Sets if the map loading is asynchronous.
     *
     * @param boolean $async TRUE if the map loading is asynchronous else FALSE.
     *
     * @throws \Ivory\GoogleMap\Exception\MapException If the async flag is not a boolean.
     */
    public function setAsync($async)
    {
        if (!is_bool($async)) {
            throw MapException::invalidAsync();
        }

        $this->async = $async;
    }

    /**
     * Check if the map autozooms.
     *
     * @return boolean TRUE if the map autozooms else FALSE.
     */
    public function isAutoZoom()
    {
        return $this->autoZoom;
    }

    /**
     * Sets if the map autozooms.
     *
     * @param boolean $autoZoom TRUE if the map autozooms else FALSE.
     *
     * @throws \Ivory\GoogleMap\Exception\MapException If the auto zoom flag is not a boolean.
     */
    public function setAutoZoom($autoZoom)
    {
        if (!is_bool($autoZoom)) {
            throw MapException::invalidAutoZoom();
        }

        $this->autoZoom = $autoZoom;
    }

    /**
     * Gets the map center.
     *
     * @return \Ivory\GoogleMap\Base\Coordinate The map center.
     */
    public function getCenter()
    {
        return $this->center;
    }

    /**
     * Sets the map center.
     *
     * Available prototypes:
     *  - function setCenter(Ivory\GoogleMap\Base\Coordinate $center)
     *  - function setCenter(double $latitude, double $longitude, boolean $noWrap = true)
     *
     * @throws \Ivory\GoogleMap\Exception\MapException If the center is not valid (prototypes).
     */
    public function setCenter()
    {
        $args = func_get_args();

        if (isset($args[0]) && ($args[0] instanceof Coordinate)) {
            $this->center = $args[0];
        } elseif ((isset($args[0]) && is_numeric($args[0])) && (isset($args[1]) && is_numeric($args[1]))) {
            $this->center->setLatitude($args[0]);
            $this->center->setLongitude($args[1]);

            if (isset($args[2]) && is_bool($args[2])) {
                $this->center->setNoWrap($args[2]);
            }
        } else {
            throw MapException::invalidCenter();
        }
    }

    /**
     * Gets the map bound.
     *
     * @return \Ivory\GoogleMap\Base\Bound The map bound.
     */
    public function getBound()
    {
        return $this->bound;
    }

    /**
     * Sets the map bound.
     *
     * Available prototypes:
     *  - function setBound(Ivory\GoogleMap\Base\Bound $bound = null)
     *  - function setBount(Ivory\GoogleMap\Base\Coordinate $southWest, Ivory\GoogleMap\Base\Coordinate $northEast)
     *  - function setBound(
     *      double $southWestLatitude,
     *      double $southWestLongitude,
     *      double $northEastLatitude,
     *      double $northEastLongitude,
     *      boolean southWestNoWrap = true,
     *      boolean $northEastNoWrap = true
     *  )
     *
     * @throws \Ivory\GoogleMap\Exception\MapException If the bound is not valid (prototypes).
     */
    public function setBound()
    {
        $args = func_get_args();

        if (isset($args[0]) && ($args[0] instanceof Bound)) {
            $this->bound = $args[0];
        } elseif ((isset($args[0]) && ($args[0] instanceof Coordinate))
            && (isset($args[1]) && ($args[1] instanceof Coordinate))
        ) {
            $this->bound->setSouthWest($args[0]);
            $this->bound->setNorthEast($args[1]);
        } elseif ((isset($args[0]) && is_numeric($args[0]))
            && (isset($args[1]) && is_numeric($args[1]))
            && (isset($args[2]) && is_numeric($args[2]))
            && (isset($args[3]) && is_numeric($args[3]))
        ) {
            $this->bound->setSouthWest(new Coordinate($args[0], $args[1]));
            $this->bound->setNorthEast(new Coordinate($args[2], $args[3]));

            if (isset($args[4]) && is_bool($args[4])) {
                $this->bound->getSouthWest()->setNoWrap($args[4]);
            }

            if (isset($args[5]) && is_bool($args[5])) {
                $this->bound->getNorthEast()->setNoWrap($args[5]);
            }
        } elseif (!isset($args[0])) {
            $this->bound->setSouthWest(null);
            $this->bound->setNorthEast(null);
        } else {
            throw MapException::invalidBound();
        }
    }

    /**
     * Checks if the map option exists.
     *
     * @param string $mapOption The map option.
     *
     * @throws \Ivory\GoogleMap\Exception\MapException If the map option is not valid.
     *
     * @return boolean TRUE if the map option exists else FALSE.
     */
    public function hasMapOption($mapOption)
    {
        if (!is_string($mapOption)) {
            throw MapException::invalidMapOption();
        }

        return isset($this->mapOptions[$mapOption]);
    }

    /**
     * Gets the map options
     *
     * @return array The map options.
     */
    public function getMapOptions()
    {
        return $this->mapOptions;
    }

    /**
     * Sets the map options.
     *
     * @param array $mapOptions The map options.
     */
    public function setMapOptions(array $mapOptions)
    {
        foreach ($mapOptions as $mapOption => $value) {
            $this->setMapOption($mapOption, $value);
        }
    }

    /**
     * Gets a specific map option.
     *
     * @param string $mapOption The map option.
     *
     * @throws \Ivory\GoogleMap\Exception\MapException If the map option does not exist.
     *
     * @return mixed The map option value.
     */
    public function getMapOption($mapOption)
    {
        if (!$this->hasMapOption($mapOption)) {
            throw MapException::mapOptionDoesNotExist($mapOption);
        }

        return $this->mapOptions[$mapOption];
    }

    /**
     * Sets a specific map option
     *
     * @param string $mapOption The map option.
     * @param mixed  $value     The map option value.
     *
     * @throws \Ivory\GoogleMap\Exception\MapException If the map option is not valid.
     */
    public function setMapOption($mapOption, $value)
    {
        if (!is_string($mapOption)) {
            throw MapException::invalidMapOption();
        }

        $this->mapOptions[$mapOption] = $value;
    }

    /**
     * Removes a map option.
     *
     * @param string $mapOption The map option.
     *
     * @throws \Ivory\GoogleMap\Exception\MapException If the map option does not exist.
     */
    public function removeMapOption($mapOption)
    {
        if (!$this->hasMapOption($mapOption)) {
            throw MapException::mapOptionDoesNotExist($mapOption);
        }

        unset($this->mapOptions[$mapOption]);
    }

    /**
     * Checks if the stylesheet option exists.
     *
     * @param string $stylesheetOption The stylesheet option.
     *
     * @throws \Ivory\GoogleMap\Exception\MapException If the stylesheet option is not valid.
     *
     * @return boolean TRUE if the stylesheet option exists else FALSE.
     */
    public function hasStylesheetOption($stylesheetOption)
    {
        if (!is_string($stylesheetOption)) {
            throw MapException::invalidStylesheetOption();
        }

        return isset($this->stylesheetOptions[$stylesheetOption]);
    }

    /**
     * Gets the stylesheet options.
     *
     * @return array The stylesheet options.
     */
    public function getStylesheetOptions()
    {
        return $this->stylesheetOptions;
    }

    /**
     * Sets the stylesheet options.
     *
     * @param array $stylesheetOptions The stylesheet options.
     */
    public function setStylesheetOptions(array $stylesheetOptions)
    {
        foreach ($stylesheetOptions as $stylesheetOption => $value) {
            $this->setStylesheetOption($stylesheetOption, $value);
        }
    }

    /**
     * Gets a specific stylesheet option.
     *
     * @param string $stylesheetOption  The stylesheet option.
     *
     * @throws \Ivory\GoogleMap\Exception\MapException If the stylesheet option does not exist.
     *
     * @return mixed The stylesheet option value.
     */
    public function getStylesheetOption($stylesheetOption)
    {
        if (!$this->hasStylesheetOption($stylesheetOption)) {
            throw MapException::stylesheetOptionDoesNotExist($stylesheetOption);
        }

        return $this->stylesheetOptions[$stylesheetOption];
    }

    /**
     * Sets a specific stylesheet option.
     *
     * @param string $stylesheetOption The stylesheet option.
     * @param mixed  $value            The stylesheet option value.
     *
     * @throws \Ivory\GoogleMap\Exception\MapException If the stylesheet option is not valid.
     */
    public function setStylesheetOption($stylesheetOption, $value)
    {
        if (!is_string($stylesheetOption)) {
            throw MapException::invalidStylesheetOption();
        }

        $this->stylesheetOptions[$stylesheetOption] = $value;
    }

    /**
     * Removes a stylesheet option.
     *
     * @param string $stylesheetOption The stylesheet option.
     *
     * @throws \Ivory\GoogleMap\Exception\MapException If the stylesheet option does not exist.
     */
    public function removeStylesheetOption($stylesheetOption)
    {
        if (!$this->hasStylesheetOption($stylesheetOption)) {
            throw MapException::stylesheetOptionDoesNotExist($stylesheetOption);
        }

        unset($this->stylesheetOptions[$stylesheetOption]);
    }

    /**
     * Gets the map controls.
     *
     * @return \Ivory\GoogleMap\Controls\Controls The map controls.
     */
    public function getControls()
    {
        return $this->controls;
    }

    /**
     * Sets the map controls.
     *
     * @param \Ivory\GoogleMap\Controls\Controls $controls The map controls.
     */
    public function setControls(Controls $controls)
    {
        $this->controls = $controls;
    }

    /**
     * Gets the map overlays.
     *
     * @return \Ivory\GoogleMap\Overlays\Overlays The map overlays.
     */
    public function getOverlays()
    {
        return $this->overlays;
    }

    /**
     * Sets the map overlays.
     *
     * @param \Ivory\GoogleMap\Overlays\Overlays $overlays The map overlays.
     */
    public function setOverlays(Overlays $overlays)
    {
        $this->overlays = $overlays;

        if ($overlays->getMap() !== $this) {
            $overlays->setMap($this);
        }
    }

    /**
     * Gets the map layers.
     *
     * @return \Ivory\GoogleMap\Layers\Layers The map layers.
     */
    public function getLayers()
    {
        return $this->layers;
    }

    /**
     * Sets the map layers.
     *
     * @param \Ivory\GoogleMap\Layers\Layers $layers The map layers.
     */
    public function setLayers(Layers $layers)
    {
        $this->layers = $layers;
    }

    /**
     * Gets the map events.
     *
     * @return \Ivory\GoogleMap\Events\Events The map events.
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * Sets the map events.
     *
     * @param \Ivory\GoogleMap\Events\Events $events The map events.
     */
    public function setEvents(Events $events)
    {
        $this->events = $events;
    }

    /**
     * Checks if the map has libraries.
     *
     * @return boolean TRUE if the map has libraries else FALSE.
     */
    public function hasLibraries()
    {
        return !empty($this->libraries);
    }

    /**
     * Gets the map libraries.
     *
     * @return array The map libraries.
     */
    public function getLibraries()
    {
        return $this->libraries;
    }

    /**
     * Sets the map libraries.
     *
     * @param array $libraries The map libraries.
     */
    public function setLibraries(array $libraries)
    {
        $this->libraries = $libraries;
    }

    /**
     * Gets the map language.
     *
     * @return string The map language.
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Sets the map langauge.
     *
     * @param string $language The map langauge.
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }
}
