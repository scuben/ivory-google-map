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

/**
 * Ivory google map exception.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapException extends Exception
{
    /**
     * Gets the "INVALID ASYNC" exception.
     *
     * @return \Ivory\GoogleMap\Exception\MapException The "INVALID ASYNC" exception.
     */
    public static function invalidAsync()
    {
        return new static('The asynchronous load of a map must be a boolean value.');
    }

    /**
     * Gets the "INVALID AUTO ZOOM" exception.
     *
     * @return \Ivory\GoogleMap\Exception\MapException The "INVALID AUTO ZOOM" exception.
     */
    public static function invalidAutoZoom()
    {
        return new static('The auto zoom of a map must be a boolean value.');
    }

    /**
     * Gets the "INVALID HTML CONTAINER ID" exception.
     *
     * @return \Ivory\GoogleMap\Exception\MapException The "INVALID HTML CONTAINER ID" exception.
     */
    public static function invalidHtmlContainerId()
    {
        return new static('The html container id of a map must be a string value.');
    }

    /**
     * Gets the "INVALID MAP OPTION" exception.
     *
     * @return \Ivory\GoogleMap\Exception\MapException The "INVALID MAP OPTION" exception.
     */
    public static function invalidMapOption()
    {
        return new static('The map option property of a map must be a string value.');
    }

    /**
     * Gets the "INVALID STYLESHEET OPTION" exception.
     *
     * @return \Ivory\GoogleMap\Exception\MapException The "INAVLID STYLESHEET OPTION" exception.
     */
    public static function invalidStylesheetOption()
    {
        return new static('The stylesheet option property of a map must be a string value.');
    }

    /**
     * Gets the "MAP OPTION DOES NOT EXIST" exception.
     *
     * @param string $mapOption The map option.
     *
     * @return \Ivory\GoogleMap\Exception\MapException The "MAP OPTION DOES NOT EXIST" exception.
     */
    public static function mapOptionDoesNotExist($mapOption)
    {
        return new static(sprintf('The map option "%s" does not exist.', $mapOption));
    }

    /**
     * Gets the "STYLESHEET OPTION DOES NOT EXIST" exception.
     *
     * @param string $stylesheetOption The stylesheet option.
     *
     * @return \Ivory\GoogleMap\Exception\MapException The "STYLESHEET OPTION DOES NOT EXIST" exception.
     */
    public static function stylesheetOptionDoesNotExist($stylesheetOption)
    {
        return new static(sprintf('The stylesheet option "%s" does not exist.', $stylesheetOption));
    }
}
