<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Overlays;

use Ivory\GoogleMap\Overlays\MarkerImage;

/**
 * Marker image test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerImageTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Overlays\MarkerImage */
    protected $markerImage;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->markerImage = new MarkerImage();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->markerImage);
    }

    public function testDefaultState()
    {
        $this->assertSame('//maps.gstatic.com/mapfiles/markers/marker.png', $this->markerImage->getUrl());
        $this->assertFalse($this->markerImage->hasAnchor());
        $this->assertFalse($this->markerImage->hasOrigin());
        $this->assertFalse($this->markerImage->hasScaledSize());
        $this->assertFalse($this->markerImage->hasSize());
    }

    public function testInitialState()
    {
        $url = 'foo';
        $anchor = $this->getMock('Ivory\GoogleMap\Base\Point');
        $origin = $this->getMock('Ivory\GoogleMap\Base\Point');
        $scaledSize = $this->getMock('Ivory\GoogleMap\Base\Size');
        $size = $this->getMock('Ivory\GoogleMap\Base\Size');

        $this->markerImage = new MarkerImage($url, $anchor, $origin, $scaledSize, $size);

        $this->assertSame($url, $this->markerImage->getUrl());
        $this->assertSame($anchor, $this->markerImage->getAnchor());
        $this->assertSame($origin, $this->markerImage->getOrigin());
        $this->assertSame($scaledSize, $this->markerImage->getScaledSize());
        $this->assertSame($size, $this->markerImage->getSize());
    }

    public function testUrlWithValidValue()
    {
        $this->markerImage->setUrl('foo');

        $this->assertSame('foo', $this->markerImage->getUrl());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\OverlayException
     * @expectedExceptionMessage The url of a maker image must be a string value.
     */
    public function testUrlWithInvalidValue()
    {
        $this->markerImage->setUrl(true);
    }

    public function testAnchor()
    {
        $point = $this->getMock('Ivory\GoogleMap\Base\Point');
        $this->markerImage->setAnchor($point);

        $this->assertSame($point, $this->markerImage->getAnchor());
    }

    public function testAnchorWithNullValue()
    {
        $this->markerImage->setAnchor($this->getMock('Ivory\GoogleMap\Base\Point'));
        $this->markerImage->setAnchor(null);

        $this->assertNull($this->markerImage->getAnchor());
    }

    public function testOrigin()
    {
        $point = $this->getMock('Ivory\GoogleMap\Base\Point');
        $this->markerImage->setOrigin($point);

        $this->assertSame($point, $this->markerImage->getOrigin());
    }

    public function testOriginWithNullValue()
    {
        $this->markerImage->setOrigin($this->getMock('Ivory\GoogleMap\Base\Point'));
        $this->markerImage->setOrigin(null);

        $this->assertNull($this->markerImage->getOrigin());
    }

    public function testScaledSize()
    {
        $size = $this->getMock('Ivory\GoogleMap\Base\Size');
        $this->markerImage->setScaledSize($size);

        $this->assertSame($size, $this->markerImage->getScaledSize());
    }

    public function testScaledSizeWithNullValue()
    {
        $this->markerImage->setScaledSize($this->getMock('Ivory\GoogleMap\Base\Size'));
        $this->markerImage->setScaledSize(null);

        $this->assertNull($this->markerImage->getScaledSize());
    }

    public function testSize()
    {
        $size = $this->getMock('Ivory\GoogleMap\Base\Size');
        $this->markerImage->setSize($size);

        $this->assertSame($size, $this->markerImage->getSize());
    }

    public function testSizeWithNullValue()
    {
        $this->markerImage->setSize($this->getMock('Ivory\GoogleMap\Base\Size'));
        $this->markerImage->setSize(null);

        $this->assertNull($this->markerImage->getSize());
    }
}
