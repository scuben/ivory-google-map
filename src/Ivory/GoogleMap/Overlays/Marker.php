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
 * Marker which describes a google map marker.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#Marker
 * @author GeLo <geloen.eric@gmail.com>
 */
class Marker extends AbstractOptionsAsset implements ExtendableInterface
{
    /** @var \Ivory\GoogleMap\Base\Coordinate */
    protected $position;

    /** @var string */
    protected $animation;

    /** @var \Ivory\GoogleMap\Overlays\MarkerImage */
    protected $icon;

    /** @var \Ivory\GoogleMap\Overlays\MarkerImage */
    protected $shadow;

    /** @var \Ivory\GoogleMap\Overlays\MarkerShape */
    protected $shape;

    /** @var \Ivory\GoogleMap\Overlays\InfoWindow */
    protected $infoWindow;

    /**
     * Creates a marker.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate      $position   The marker position.
     * @param string                                $animation  The marker animation.
     * @param \Ivory\GoogleMap\Overlays\MarkerImage $icon       The marker icon.
     * @param \Ivory\GoogleMap\Overlays\MarkerImage $shadow     The marker shadow.
     * @param \Ivory\GoogleMap\Overlays\MarkerShape $shape      The marker shape.
     * @param \Ivory\GoogleMap\Overlays\InfoWindow  $infoWindow The marker info window.
     */
    public function __construct(
        Coordinate $position = null,
        $animation = null,
        MarkerImage $icon = null,
        MarkerImage $shadow = null,
        MarkerShape $shape = null,
        InfoWindow $infoWindow = null
    ) {
        parent::__construct();

        $this->setPrefixJavascriptVariable('marker_');

        if ($position === null) {
            $position = new Coordinate();
        }

        $this->setPosition($position);

        if ($animation !== null) {
            $this->setAnimation($animation);
        }

        if ($icon !== null) {
            $this->setIcon($icon);
        }

        if ($shadow !== null) {
            $this->setShadow($shadow);
        }

        if ($shape !== null) {
            $this->setShape($shape);
        }

        if ($infoWindow !== null) {
            $this->setInfoWindow($infoWindow);
        }
    }

    /**
     * Gets the marker position.
     *
     * @return \Ivory\GoogleMap\Base\Coordinate The marker position.
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Sets the marker position.
     *
     * @param \Ivory\GoogleMap\Base\Coordinate|null $position The position.
     */
    public function setPosition(Coordinate $position = null)
    {
        $this->position = $position;
    }

    /**
     * Checks if the marker has an animation.
     *
     * @return boolean TRUE if the marker has an animation else FALSE.
     */
    public function hasAnimation()
    {
        return $this->animation !== null;
    }

    /**
     * Gets the marker animation.
     *
     * @return string The marker animation.
     */
    public function getAnimation()
    {
        return $this->animation;
    }

    /**
     * Sets the marker animation.
     *
     * @param string $animation The marker animation.
     *
     * @throws \Ivory\GoogleMap\Exception\OverlayException If the animation is not valid.
     */
    public function setAnimation($animation = null)
    {
        if (!in_array($animation, Animation::getAnimations()) && ($animation !== null)) {
            throw OverlayException::invalidMarkerAnimation();
        }

        $this->animation = $animation;
    }

    /**
     * Checks if the marker has an icon.
     *
     * @return boolean TRUE if the marker has an icon else FALSE.
     */
    public function hasIcon()
    {
        return $this->icon !== null;
    }

    /**
     * Gets the marker icon.
     *
     * @return \Ivory\GoogleMap\Overlays\MarkerImage The marker image.
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Sets the marker icon.
     *
     * @param \Ivory\GoogleMap\Overlays\MarkerImage|null $markerImage The marker icon.
     *
     * @throws \Ivory\GoogleMap\Exception\OverlayException If the icon is invalid.
     */
    public function setIcon(MarkerImage $markerImage = null)
    {
        if ($markerImage !== null && $markerImage->getUrl() === null) {
            throw OverlayException::invalidMarkerIconUrl();
        }

        $this->icon = $markerImage;
    }

    /**
     * Checks if the marker has a shadow.
     *
     * @return boolean TRUE if the marker has a shadow else FALSE.
     */
    public function hasShadow()
    {
        return $this->shadow !== null;
    }

    /**
     * Gets the marker shadow.
     *
     * @return \Ivory\GoogleMap\Overlays\MarkerImage The marker shadow.
     */
    public function getShadow()
    {
        return $this->shadow;
    }

    /**
     * Sets the marker shadow.
     *
     * @param \Ivory\GoogleMap\Overlays\MarkerImage|null $markerImage The marker shadow.
     *
     * @throws \Ivory\GoogleMap\Exception\OverlayException If the icon is invalid.
     */
    public function setShadow(MarkerImage $markerImage = null)
    {
        if ($markerImage !== null && $markerImage->getUrl() === null) {
            throw OverlayException::invalidMarkerShadowUrl();
        }

        $this->shadow = $markerImage;
    }

    /**
     * Checks if the marker has a shape.
     *
     * @return boolean TRUE if the marker has a shape else FALSE.
     */
    public function hasShape()
    {
        return $this->shape !== null;
    }

    /**
     * Gets the marker shape.
     *
     * @return \Ivory\GoogleMap\Overlays\MarkerShape The marker shape.
     */
    public function getShape()
    {
        return $this->shape;
    }

    /**
     * Sets the marker shape.
     *
     * @param \Ivory\GoogleMap\Overlays\MarkerShape|null $shape The marker shape.
     *
     * @throws \Ivory\GoogleMap\Exception\OverlayException If the marker shape is invalid.
     */
    public function setShape(MarkerShape $shape = null)
    {
        $args = func_get_args();

        if ($shape !== null && !$args[0]->hasCoordinates()) {
            throw OverlayException::invalidMarkerShapeCoordinates();
        }

        $this->shape = $shape;
    }

    /**
     * Check if the marker has an info window.
     *
     * @return boolean TRUE if the marker has an info window else FALSE.
     */
    public function hasInfoWindow()
    {
        return $this->infoWindow !== null;
    }

    /**
     * Gets the info window.
     *
     * @return \Ivory\GoogleMap\Overlays\InfoWindow The info window.
     */
    public function getInfoWindow()
    {
        return $this->infoWindow;
    }

    /**
     * Sets the info window.
     *
     * @param \Ivory\GoogleMap\Overlays\InfoWindow $infoWindow The info window.
     */
    public function setInfoWindow(InfoWindow $infoWindow)
    {
        $this->infoWindow = $infoWindow;
    }
}
