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
use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Exception\OverlayException;

/**
 * Rectangle which describes a google map rectangle.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Rectangle extends AbstractOptionsAsset implements ExtendableInterface
{
    /** @var \Ivory\GoogleMap\Base\Bound */
    protected $bound;

    /**
     * Creates a rectangle.
     */
    public function __construct(Bound $bound = null)
    {
        parent::__construct();

        $this->setPrefixJavascriptVariable('rectangle_');

        if ($bound === null) {
            $bound = new Bound(new Coordinate(-1, -1), new Coordinate(1, 1));
        }

        $this->setBound($bound);
    }

    /**
     * Gets the rectangle bound.
     *
     * @return \Ivory\GoogleMap\Base\Bound The rectangle bound.
     */
    public function getBound()
    {
        return $this->bound;
    }

    /**
     * Sets the rectangle bound.
     *
     * @param \Ivory\GoogleMap\Base\Bound $bound The bound.
     *
     * @throws \Ivory\GoogleMap\Exception\OverlayException If the bound is invalid.
     */
    public function setBound(Bound $bound)
    {
        if (!$bound->hasCoordinates()) {
            throw OverlayException::invalidRectangleBoundCoordinates();
        }

        $this->bound = $bound;
    }
}
