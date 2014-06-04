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

use Ivory\GoogleMap\Assets\AbstractJavascriptVariableAsset;
use Ivory\GoogleMap\Base\Point;
use Ivory\GoogleMap\Base\Size;
use Ivory\GoogleMap\Exception\OverlayException;

/**
 * Marker image which describes a google map marker image.
 *
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html#MarkerImage
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerImage extends AbstractJavascriptVariableAsset
{
    /** @var string */
    protected $url;

    /** @var \Ivory\GoogleMap\Base\Point */
    protected $anchor;

    /** @var \Ivory\GoogleMap\Base\Point */
    protected $origin;

    /** @var \Ivory\GoogleMap\Base\Size */
    protected $scaledSize;

    /** @var Ivory\GoogleMap\Base\Size */
    protected $size;

    /**
     * Create a marker image.
     */
    public function __construct(
        $url = '//maps.gstatic.com/mapfiles/markers/marker.png',
        Point $anchor = null,
        Point $origin = null,
        Size $scaledSize = null,
        Size $size = null
    ) {
        $this->setPrefixJavascriptVariable('marker_image_');
        $this->setUrl($url);

        if ($anchor !== null) {
            $this->setAnchor($anchor);
        }

        if ($origin !== null) {
            $this->setOrigin($origin);
        }

        if ($scaledSize !== null) {
            $this->setScaledSize($scaledSize);
        }

        if ($size !== null) {
            $this->setSize($size);
        }
    }

    /**
     * Gets the url of the marker image.
     *
     * @return string The url of the marker image.
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Sets the url of the marker image.
     *
     * @param string $url The url of the marker image.
     *
     * @throws \Ivory\GoogleMap\Exception\OverlayException If the url is not valid.
     */
    public function setUrl($url)
    {
        if (!is_string($url)) {
            throw OverlayException::invalidMarkeImageUrl();
        }

        $this->url = $url;
    }

    /**
     * Checks if the marker image has an anchor.
     *
     * @return boolean TRUE if the marker image has an anchor else FALSE.
     */
    public function hasAnchor()
    {
        return $this->anchor !== null;
    }

    /**
     * Gets the anchor of the marker image.
     *
     * @return \Ivory\GoogleMap\Base\Point The marker image anchor.
     */
    public function getAnchor()
    {
        return $this->anchor;
    }

    /**
     * Sets the anchor of the marker image.
     *
     * @param \Ivory\GoogleMap\Base\Point|null $anchor The anchor.
     */
    public function setAnchor(Point $anchor = null)
    {
        $this->anchor = $anchor;
    }

    /**
     * Checks if the marker image has an origin.
     *
     * @return boolean TRUE if the marker image has an origin else FALSE.
     */
    public function hasOrigin()
    {
        return $this->origin !== null;
    }

    /**
     * Gets the origin of the marker image.
     *
     * @return \Ivory\GoogleMap\Base\Point The marker image origin.
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * Sets the origin of the marker image.
     *
     * @param \Ivory\GoogleMap\Base\Point $origin The origin.
     */
    public function setOrigin(Point $origin = null)
    {
        $this->origin = $origin;
    }

    /**
     * Checks if the marker image has a scaled size else FALSE.
     *
     * @return boolean TRUE if the marker image has a scaled size else FALSE.
     */
    public function hasScaledSize()
    {
        return $this->scaledSize !== null;
    }

    /**
     * Gets the scaled size of the marker image.
     *
     * @return \Ivory\GoogleMap\Base\Size The marker image scaled size.
     */
    public function getScaledSize()
    {
        return $this->scaledSize;
    }

    /**
     * Sets the scaled size of the marker image.
     *
     * @param \Ivory\GoogleMap\Base\Size|null $scaledSize The scaled size.
     */
    public function setScaledSize(Size $scaledSize = null)
    {
        $this->scaledSize = $scaledSize;
    }

    /**
     * Checks if the marker image has a size.
     *
     * @return boolean TRUE if the marker image has a size else FALSE.
     */
    public function hasSize()
    {
        return $this->size !== null;
    }

    /**
     * Gets the size of the marker image.
     *
     * @return \Ivory\GoogleMap\Base\Size The marker image size.
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Sets the size of the marker image.
     *
     * @param \Ivory\GoogleMap\Base\Size|null $size The size.
     */
    public function setSize(Size $size = null)
    {
        $this->size = $size;
    }
}
