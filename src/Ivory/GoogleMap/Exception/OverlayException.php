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

use Ivory\GoogleMap\Events\MouseEvent;
use Ivory\GoogleMap\Overlays\Animation;

/**
 * Overlay exception.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class OverlayException extends Exception
{
    /**
     * Gets the "INVALID CIRCLE RADIUS" exception.
     *
     * @return \Ivory\GoogleMap\Exception\OverlayException The "INVALID CIRCLE RADIUS" exception.
     */
    public static function invalidCircleRadius()
    {
        return new static('The radius of a circle must be a numeric value.');
    }

    /**
     * Gets the "INVALID ENCODED POLYLINE VALUE" exception.
     *
     * @return \Ivory\GoogleMap\Exception\OverlayException The "INVALID ENCODED POLYLINE VALUE" exception.
     */
    public static function invalidEncodedPolylineValue()
    {
        return new static('The encoded polyline value must be a string value.');
    }

    /**
     * Gets the "INVALID GROUND OVERLAY BOUND COORDINATES" exception.
     *
     * @return \Ivory\GoogleMap\Exception\OverlayException The "INVALID GROUND OVERLAY BOUND COORDINATES" exception.
     */
    public static function invalidGroundOverlayBoundCoordinates()
    {
        return new static('A ground overlay bound must have a south west & a north east coordinate.');
    }

    /**
     * Gets the "INVALID GROUND OVERLAY URL" exception.
     *
     * @return \Ivory\GoogleMap\Exception\OverlayException The "INVALID GROUND OVERLAY URL" exception.
     */
    public static function invalidGroundOverlayUrl()
    {
        return new static('The url of a ground overlay must be a string value.');
    }

    /**
     * Gets the "INVALID INFO WINDOW AUTO CLOSE" exception.
     *
     * @return \Ivory\GoogleMap\Exception\OverlayException The "INVALID INFO WINDOW AUTO CLOSE" exception.
     */
    public static function invalidInfoWindowAutoClose()
    {
        return new static('The info window auto close flag must be a boolean value.');
    }

    /**
     * Gets the "INVALID INFO WINDOW AUTO OPEN" exception.
     *
     * @return \Ivory\GoogleMap\Exception\OverlayException The "INVALID INFO WINDOW AUTO OPEN" exception.
     */
    public static function invalidInfoWindowAutoOpen()
    {
        return new static('The auto open property of an info window must be a boolean value.');
    }

    /**
     * Gets the "INVALID INFO WINDOW CONTENT" exception.
     *
     * @return \Ivory\GoogleMap\Exception\OverlayException The "INVALID INFO WINDOW CONTENT" exception.
     */
    public static function invalidInfoWindowContent()
    {
        return new static('The content of an info window must be a string value.');
    }

    /**
     * Gets the "INVALID INFO WINDOW OPEN" exception.
     *
     * @return \Ivory\GoogleMap\Exception\OverlayException The "INVALID INFO WINDOW OPEN" exception.
     */
    public static function invalidInfoWindowOpen()
    {
        return new static('The open property of an info window must be a boolean value.');
    }

    /**
     * Gets the "INVALID INFO WINDOW OPEN EVENT" exception.
     *
     * @return \Ivory\GoogleMap\Exception\OverlayException The "INVALID INFO WINDOW OPEN EVENT" exception.
     */
    public static function invalidInfoWindowOpenEvent()
    {
        return new static(sprintf(
            'The only available open event are : %s.',
            implode(', ', MouseEvent::getMouseEvents())
        ));
    }

    /**
     * Gets the "INVALID MARKER ANIMATION" exception.
     *
     * @return \Ivory\GoogleMap\Exception\OverlayException The "INVALID MARKER ANIMATION" exception.
     */
    public static function invalidMarkerAnimation()
    {
        return new static(sprintf(
            'The animation of a marker can only be : %s.',
            implode(', ', Animation::getAnimations())
        ));
    }

    /**
     * Gets the "INVALID MARKER ICON URL" exception.
     *
     * @return \Ivory\GoogleMap\Exception\OverlayException The "INVALID MARKER ICON URL" exception.
     */
    public static function invalidMarkerIconUrl()
    {
        return new static('A marker image icon must have an url.');
    }

    /**
     * Gets the "INVALID MARKER IMAGE URL" exception.
     *
     * @return \Ivory\GoogleMap\Exception\OverlayException The "INVALID MARKER IMAGE URL" exception.
     */
    public static function invalidMarkeImageUrl()
    {
        return new static('The url of a maker image must be a string value.');
    }

    /**
     * Gets the "INVALID MARKER SHADOW URL" exception.
     *
     * @return \Ivory\GoogleMap\Exception\OverlayException The "INVALID MARKER SHADOW URL" exception.
     */
    public static function invalidMarkerShadowUrl()
    {
        return new static('A marker image shadow must have an url.');
    }

    /**
     * Gets the "INVALID MARKER SHAPE COORDINATES" exception.
     *
     * @return \Ivory\GoogleMap\Exception\OverlayException The "INVALID MARKER SHAPE COORDINATES" exception.
     */
    public static function invalidMarkerShapeCoordinates()
    {
        return new static('A marker shape must have coordinates.');
    }

    /**
     * Gets the "INVALID MARKER SHAPE ADD POLY COORDINATE CALL" exception.
     *
     * @return \Ivory\GoogleMap\Exception\OverlayException The "INVALID MARKER SHAPE ADD POLY COORDINATE CALL"
     *                                                     exception.
     */
    public static function invalidMarkerShapeAddPolyCoordinateCall()
    {
        return new static(sprintf(
            'The %s method can only be use with a marker shape which has type poly.',
            'MarkerShape::addPolyCoordinate($x, $y)'
        ));
    }

    /**
     * Gets the "INVALID MARKER SHAPE TYPE" exception.
     *
     * @return \Ivory\GoogleMap\Exception\OverlayException The "INVALID MARKER SHAPE TYPE" exception.
     */
    public static function invalidMarkerShapeType()
    {
        return new static(sprintf(
            'The type of a marker shape can only be : %s.',
            implode(', ', array('circle', 'poly', 'rect'))
        ));
    }

    /**
     * Gets the "INVALID MARKER SHAPE CIRCLE COORDINATES" exception.
     *
     * @return \Ivory\GoogleMap\Exception\OverlayException The "INVALID MARKER SHAPE CIRCLE COORDINATES" exception.
     */
    public static function invalidMarkerShapeCircleCoordinates()
    {
        return new static(sprintf(
            '%s'.PHP_EOL.'%s',
            'The coordinates setter arguments is invalid if the marker shape type is circle.',
            'The available prototype is : function setCoordinates(array(double $x, double $y, double $r))'
        ));
    }

    /**
     * Gets the "INVALID MARKER SHAPE POLY COORDINATE" exception.
     *
     * @return \Ivory\GoogleMap\Exception\OverlayException The "INVALID MARKER SHAPE POLY COORDINATE" exception.
     */
    public static function invalidMarkerShapePolyCoordinate()
    {
        return new static('The x & y coordinates of a poly marker shape must be numeric values.');
    }

    /**
     * Gets the "INVALID MARKER SHAPE POLY COORDINATES" exception.
     *
     * @return \Ivory\GoogleMap\Exception\OverlayException The "INVALID MARKER SHAPE POLY COORDINATES" exception.
     */
    public static function invalidMarkerShapePolyCoordinates()
    {
        return new static(sprintf(
            '%s'.PHP_EOL.'%s',
            'The coordinates setter arguments is invalid if the marker shape type is poly.',
            'The available prototype is : function setCoordinates('.
            'array(double $x1, double $y1, '.
            '..., '.
            'double $xn, double $yn'.
            ')'
        ));
    }

    /**
     * Gets the "INVALID MARKER SHAPE RECT COORDINATES" exception.
     *
     * @return \Ivory\GoogleMap\Exception\OverlayException The "INVALID MARKER SHAPE RECT COORDINATES" exception.
     */
    public static function invalidMarkerShapeRectCoordinates()
    {
        return new static(sprintf(
            '%s'.PHP_EOL.'%s',
            'The coordinates setter arguments is invalid if the marker shape type is rect.',
            'The available prototype is : function setCoordinates('.
            'array(double $x1, double $y1, double $x2, double $y2)'.
            ')'
        ));
    }

    /**
     * Gets the "INVALID RECTANGLE BOUND COORDINATES" exception.
     *
     * @return \Ivory\GoogleMap\Exception\OverlayException The "INVALID RECTANGLE BOUND COORDINATES" exception.
     */
    public static function invalidRectangleBoundCoordinates()
    {
        return new static('A rectangle bound must have a south west & a north east coordinate.');
    }
}
