<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Exception;

use Ivory\GoogleMap\Controls\ControlPosition;
use Ivory\GoogleMap\Controls\MapTypeControlStyle;
use Ivory\GoogleMap\Controls\ScaleControlStyle;
use Ivory\GoogleMap\Controls\ZoomControlStyle;
use Ivory\GoogleMap\MapTypeId;

/**
 * Control exception.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ControlException extends Exception
{
    /**
     * Gets the "INVALID CONTROL POSITION" exception.
     *
     * @return \Ivory\GoogleMap\Exception\ControlException The "INVALID CONTROL POSITION" exception.
     */
    public static function invalidControlPosition()
    {
        return new static(sprintf(
            'The control position can only be : %s.',
            implode(', ', ControlPosition::getControlPositions())
        ));
    }

    /**
     * Gets the "INVALID MAP TYPE CONTROL" exception.
     *
     * @return \Ivory\GoogleMap\Exception\ControlException The "INAVLID MAP TYPE CONTROL" exception.
     */
    public static function invalidMapTypeControl()
    {
        return new static(sprintf(
            '%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
            'The map type control setter arguments is invalid.',
            'The available prototypes are :',
            ' - function setMapTypeControl(Ivory\GoogleMap\Controls\MapTypeControl $mapTypeControl = null)',
            ' - function setMaptypeControl(array $mapTypeIds, string $controlPosition, string $mapTypeControlStyle)'
        ));
    }

    /**
     * Gets the "INVALID MAP TYPE CONTROL STYLE" exception.
     *
     * @return \Ivory\GoogleMap\Exception\ControlException The "INVALID MAP TYPE CONTROL STYLE" exception.
     */
    public static function invalidMapTypeControlStyle()
    {
        return new static(sprintf(
            'The map type control style can only be : %s.',
            implode(', ', MapTypeControlStyle::getMapTypeControlStyles())
        ));
    }

    /**
     * Gets the "INVALID MAP TYPE ID" exception.
     *
     * @return \Ivory\GoogleMap\Exception\ControlException The "INVALID MAP TYPE ID" exception.
     */
    public static function invalidMapTypeId()
    {
        return new static(sprintf('The map type id can only be : %s.', implode(', ', MapTypeId::getMapTypeIds())));
    }

    /**
     * Gets the "INVALID OVERVIEW MAP CONTROL" exception.
     *
     * @return \Ivory\GoogleMap\Exception\MapException The "INVALID OVERVIEW MAP CONTROL" exception.
     */
    public static function invalidOverviewMapControl()
    {
        return new static(sprintf(
            '%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
            'The overview map control setter arguments is invalid.',
            'The available prototypes are :',
            ' - function setOverviewMapControl(Ivory\GoogleMap\Controls\OverviewMapControl $overviewMapControl = null)',
            ' - function setOverviewMapControl(boolean $opened)'
        ));
    }

    /**
     * Gets the "INVALID OVERVIEW MAP CONTROL OPENED" exception.
     *
     * @return \Ivory\GoogleMap\Exception\ControlException The "INVALID OVERVIEW MAP CONTROL OPENED" exception.
     */
    public static function invalidOverviewMapControlOpened()
    {
        return new static('The opened property of an overview map control must be a boolean value.');
    }

    /**
     * Gets the "INVALID PAN CONTROL" exception.
     *
     * @return \Ivory\GoogleMap\Exception\MapException The "INVALID PAN CONTROL" exception.
     */
    public static function invalidPanControl()
    {
        return new static(sprintf(
            '%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
            'The pan control setter arguments is invalid.',
            'The available prototypes are :',
            ' - function setPanControl(Ivory\GoogleMap\Controls\PanControl $panControl = null)',
            ' - function setPanControl(string $controlPosition)'
        ));
    }

    /**
     * Gets the "INVALID ROTATE CONTROL" exception.
     *
     * @return \Ivory\GoogleMap\Exception\MapException The "INVALID ROTATE CONTROL" exception.
     */
    public static function invalidRotateControl()
    {
        return new static(sprintf(
            '%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
            'The rotate control setter arguments is invalid.',
            'The available prototypes are :',
            ' - function setRotateControl(Ivory\GoogleMap\Controls\RotateControl $rotateControl = null)',
            ' - function setRotateControl(string $controlPosition)'
        ));
    }

    /**
     * Gets the "INVALID SCALE CONTROL" exception.
     *
     * @return \Ivory\GoogleMap\Exception\MapException The "INVALID SCALE CONTROL" exception.
     */
    public static function invalidScaleControl()
    {
        return new static(sprintf(
            '%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
            'The scale control setter arguments is invalid.',
            'The available prototypes are :',
            ' - function setScaleControl(Ivory\GoogleMap\Controls\ScaleControl $scaleControl = null)',
            ' - function setScaleControl(string $controlPosition, string $scaleControlStyle)'
        ));
    }

    /**
     * Gets the "INVALID SCALE CONTROL STYLE" exception.
     *
     * @return \Ivory\GoogleMap\Exception\ControlException The "INVALID SCALE CONTROL STYLE" exception.
     */
    public static function invalidScaleControlStyle()
    {
        return new static(sprintf(
            'The scale control style of a scale control can only be : %s.',
            implode(', ', ScaleControlStyle::getScaleControlStyles())
        ));
    }

    /**
     * Gets the "INVALID STREET VIEW CONTROL" exception.
     *
     * @return \Ivory\GoogleMap\Exception\MapException The "INVALID STREET VIEW CONTROL" exception.
     */
    public static function invalidStreetViewControl()
    {
        return new static(sprintf(
            '%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
            'The street view control setter arguments is invalid.',
            'The available prototypes are :',
            ' - function setStreetViewControl(Ivory\GoogleMap\Controls\StreetViewControl $streetViewControl = null)',
            ' - function setStreetViewControl(string $controlPosition)'
        ));
    }

    /**
     * Gets the "INVALID ZOOM CONTROL" exception.
     *
     * @return \Ivory\GoogleMap\Exception\MapException The "INVALID ZOOM CONTROL" exception.
     */
    public static function invalidZoomControl()
    {
        return new static(sprintf(
            '%s'.PHP_EOL.'%s'.PHP_EOL.'%s'.PHP_EOL.'%s',
            'The zoom control setter arguments is invalid.',
            'The available prototypes are :',
            ' - function setZoomControl(Ivory\GoogleMap\Controls\ZoomControl $zoomControl = null)',
            ' - function setZoomControl(string $controlPosition, string $zoomControlStyle)'
        ));
    }

    /**
     * Gets the "INVALID ZOOM CONTROL STYLE" exception.
     *
     * @return \Ivory\GoogleMap\Exception\ControlException The "INVALID ZOOM CONTROL STYLE" exception.
     */
    public static function invalidZoomControlStyle()
    {
        return new static(sprintf(
            'The zoom control style of a zoom control can only be : %s.',
            implode(', ', ZoomControlStyle::getZoomControlStyles())
        ));
    }
}
