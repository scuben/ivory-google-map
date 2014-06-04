<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Overlays;

use Ivory\GoogleMap\Assets\AbstractOptionsAsset;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Exception\OverlayException;

/**
 * Polyline which describes a google map polyline.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Polyline
 * @author GeLo <geloen.eric@gmail.com>
 */
class Polyline extends AbstractOptionsAsset implements ExtendableInterface
{
    /** @var array */
    protected $coordinates;

    /**
     * Creates a polyline.
     *
     * @param array $coordinates The polyline coordinates.
     */
    public function __construct(array $coordinates = array())
    {
        parent::__construct();

        $this->setPrefixJavascriptVariable('polyline_');
        $this->setCoordinates($coordinates);
    }

    /**
     * Checks if the polyline has coordinates.
     *
     * @return boolean TRUE if the polyline has coordinates else FALSE.
     */
    public function hasCoordinates()
    {
        return !empty($this->coordinates);
    }

    /**
     * Gets the polyline coordinates.
     *
     * @return array The polyline coordinates.
     */
    public function getCoordinates()
    {
        return $this->coordinates;
    }

    /**
     * Sets the polyline coordinates.
     *
     * @param array $coordinates The polyline coordinates.
     */
    public function setCoordinates($coordinates)
    {
        $this->coordinates = array();

        foreach ($coordinates as $coordinate) {
            $this->addCoordinate($coordinate);
        }
    }

    /**
     * Add a coordinate to the polyline.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate $coordinate The coordinate.
     */
    public function addCoordinate(Coordinate $coordinate)
    {
        $this->coordinates[] = $coordinate;
    }
}
