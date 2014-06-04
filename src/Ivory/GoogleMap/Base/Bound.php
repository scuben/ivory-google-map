<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Base;

use Ivory\GoogleMap\Assets\AbstractJavascriptVariableAsset;
use Ivory\GoogleMap\Exception\BaseException;
use Ivory\GoogleMap\Overlays\ExtendableInterface;

/**
 * Bound wich describes a google map bound.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#LatLngBounds
 * @author GeLo <geloen.eric@gmail.com>
 */
class Bound extends AbstractJavascriptVariableAsset
{
    /** @var \Ivory\GoogleMap\Base\Coordinate */
    protected $southWest;

    /** @var \Ivory\GoogleMap\Base\Coordinate */
    protected $northEast;

    /** @var array */
    protected $extends;

    /**
     * Creates a bound.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate|null $southWest The south west coordinate.
     * @param \Ivory\GoogleMap\Base\Coordinate|null $northEast The north east coordinate.
     * @param array                                 $extends   The extended overlays.
     */
    public function __construct(Coordinate $southWest = null, Coordinate $northEast = null, array $extends = array())
    {
        $this->setPrefixJavascriptVariable('bound_');

        $this->setSouthWest($southWest);
        $this->setNorthEast($northEast);
        $this->setExtends($extends);
    }

    /**
     * Checks if the bound has coordinates.
     *
     * @return boolean TRUE if the bound has coordinates else FALSE.
     */
    public function hasCoordinates()
    {
        return ($this->southWest !== null) && ($this->northEast !== null);
    }

    /**
     * Gets the south west coordinate.
     *
     * @return \Ivory\GoogleMap\Base\Coordinate The south west coordinate.
     */
    public function getSouthWest()
    {
        return $this->southWest;
    }

    /**
     * Sets the south west coordinate.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate|null $southWest The south west coordinate.
     */
    public function setSouthWest(Coordinate $southWest = null)
    {
        $this->southWest = $southWest;
    }

    /**
     * Gets the north east coordinate.
     *
     * @return \Ivory\GoogleMap\Base\Coordinate The northh east coordinate.
     */
    public function getNorthEast()
    {
        return $this->northEast;
    }

    /**
     * Sets the north east coordinate.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate|null $northEast The north east coordinate.
     */
    public function setNorthEast(Coordinate $northEast = null)
    {
        $this->northEast = $northEast;
    }

    /**
     * Checks if the bound extends something.
     *
     * @return boolean TRUE if the bound extends somethind else FALSE.
     */
    public function hasExtends()
    {
        return !empty($this->extends);
    }

    /**
     * Gets the google map objects that the bound extends.
     *
     * @return array The objects that the bound extends.
     */
    public function getExtends()
    {
        return $this->extends;
    }

    /**
     * Sets the google map objects that the bound extends.
     *
     * @param array $extends The objects that the bound extends.
     */
    public function setExtends($extends)
    {
        $this->extends = array();

        foreach ($extends as $extend) {
            $this->extend($extend);
        }
    }

    /**
     * Adds an object that the bound extends.
     *
     * @param \Ivory\GoogleMap\Overlays\ExtendableInterface $extend The object that the bound extends.
     */
    public function extend(ExtendableInterface $extend)
    {
        $this->extends[] = $extend;
    }

    /**
     * Gets the center of the bound.
     *
     * @return \Ivory\GoogleMap\Base\Coordinate The bound center.
     */
    public function getCenter()
    {
        return new Coordinate(
            ($this->southWest->getLatitude() + $this->northEast->getLatitude()) / 2,
            ($this->southWest->getLongitude() + $this->northEast->getLongitude()) / 2
        );
    }
}
