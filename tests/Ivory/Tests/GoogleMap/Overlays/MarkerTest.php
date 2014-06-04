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

use Ivory\GoogleMap\Overlays\Animation;
use Ivory\GoogleMap\Overlays\Marker;

/**
 * Marker test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MarkerTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Overlays\Marker */
    protected $marker;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->marker = new Marker();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->marker);
    }

    public function testDefaultState()
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Base\Coordinate', $this->marker->getPosition());
        $this->assertFalse($this->marker->hasAnimation());
        $this->assertFalse($this->marker->hasIcon());
        $this->assertFalse($this->marker->hasShadow());
        $this->assertFalse($this->marker->hasShape());
        $this->assertFalse($this->marker->hasInfoWindow());
    }

    public function testInitialState()
    {
        $position = $this->getMock('Ivory\GoogleMap\Base\Coordinate');
        $animation = Animation::DROP;

        $icon = $this->getMock('Ivory\GoogleMap\Overlays\MarkerImage');
        $icon
            ->expects($this->once())
            ->method('getUrl')
            ->will($this->returnValue('foo'));

        $shadow = $this->getMock('Ivory\GoogleMap\Overlays\MarkerImage');
        $shadow
            ->expects($this->once())
            ->method('getUrl')
            ->will($this->returnValue('foo'));

        $shape = $this->getMock('Ivory\GoogleMap\Overlays\MarkerShape');
        $shape
            ->expects($this->once())
            ->method('hasCoordinates')
            ->will($this->returnValue(true));

        $infoWindow = $this->getMock('Ivory\GoogleMap\Overlays\InfoWindow');

        $this->marker = new Marker($position, $animation, $icon, $shadow, $shape, $infoWindow);

        $this->assertSame($position, $this->marker->getPosition());
        $this->assertSame($animation, $this->marker->getAnimation());
        $this->assertSame($icon, $this->marker->getIcon());
        $this->assertSame($shadow, $this->marker->getShadow());
        $this->assertSame($shape, $this->marker->getShape());
        $this->assertSame($infoWindow, $this->marker->getInfoWindow());
    }

    public function testPosition()
    {
        $coordinate = $this->getMock('ivory\GoogleMap\Base\Coordinate');
        $this->marker->setPosition($coordinate);

        $this->assertSame($coordinate, $this->marker->getPosition());
    }

    public function testPositionWithNullValue()
    {
        $this->marker->setPosition($this->getMock('ivory\GoogleMap\Base\Coordinate'));
        $this->marker->setPosition(null);

        $this->assertNull($this->marker->getPosition());
    }

    public function testAnimationWithValidValue()
    {
        $this->marker->setAnimation(Animation::DROP);

        $this->assertSame(Animation::DROP, $this->marker->getAnimation());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\OverlayException
     * @expectedExceptionMessage The animation of a marker can only be : bounce, drop.
     */
    public function testAnimationWithInvalidValue()
    {
        $this->marker->setAnimation('foo');
    }

    public function testIcon()
    {
        $markerImage = $this->getMock('Ivory\GoogleMap\Overlays\MarkerImage');
        $markerImage
            ->expects($this->once())
            ->method('getUrl')
            ->will($this->returnValue('foo'));

        $this->marker->setIcon($markerImage);

        $this->assertSame($markerImage, $this->marker->getIcon());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\OverlayException
     * @expectedExceptionMessage A marker image icon must have an url.
     */
    public function testIconWithInvalidMarkerImage()
    {
        $markerImage = $this->getMock('Ivory\GoogleMap\Overlays\MarkerImage');
        $this->marker->setIcon($markerImage);
    }

    public function testIconWithNullValue()
    {
        $markerImage = $this->getMock('Ivory\GoogleMap\Overlays\MarkerImage');
        $markerImage
            ->expects($this->once())
            ->method('getUrl')
            ->will($this->returnValue('foo'));

        $this->marker->setIcon($markerImage);
        $this->marker->setIcon(null);

        $this->assertNull($this->marker->getIcon());
    }

    public function testShadow()
    {
        $markerImage = $this->getMock('Ivory\GoogleMap\Overlays\MarkerImage');
        $markerImage
            ->expects($this->once())
            ->method('getUrl')
            ->will($this->returnValue('foo'));

        $this->marker->setShadow($markerImage);

        $this->assertSame($markerImage, $this->marker->getShadow());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\OverlayException
     * @expectedExceptionMessage A marker image shadow must have an url.
     */
    public function testShadowWithInvalidMarkerImage()
    {
        $markerImage = $this->getMock('Ivory\GoogleMap\Overlays\MarkerImage');
        $this->marker->setShadow($markerImage);
    }

    public function testShadowWithNullValue()
    {
        $markerImage = $this->getMock('Ivory\GoogleMap\Overlays\MarkerImage');
        $markerImage
            ->expects($this->once())
            ->method('getUrl')
            ->will($this->returnValue('foo'));
        $this->marker->setShadow($markerImage);
        $this->marker->setShadow(null);

        $this->assertNull($this->marker->getShadow());
    }

    public function testShape()
    {
        $markerShape = $this->getMock('Ivory\GoogleMap\Overlays\MarkerShape');
        $markerShape
            ->expects($this->once())
            ->method('hasCoordinates')
            ->will($this->returnValue(true));

        $this->marker->setShape($markerShape);

        $this->assertSame($markerShape, $this->marker->getShape());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\OverlayException
     * @expectedExceptionMessage A marker shape must have coordinates.
     */
    public function testShapeWithInvalidMarkerShape()
    {
        $markerShape = $this->getMock('Ivory\GoogleMap\Overlays\MarkerShape');
        $this->marker->setShape($markerShape);
    }

    public function testShapeWithNullValue()
    {
        $markerShape = $this->getMock('Ivory\GoogleMap\Overlays\MarkerShape');
        $markerShape
            ->expects($this->once())
            ->method('hasCoordinates')
            ->will($this->returnValue(true));

        $this->marker->setShape($markerShape);
        $this->marker->setShape(null);

        $this->assertNull($this->marker->getShape());
    }

    public function testInfoWindow()
    {
        $infoWindow = $this->getMock('Ivory\GoogleMap\Overlays\InfoWindow');
        $this->marker->setInfoWindow($infoWindow);

        $this->assertSame($infoWindow, $this->marker->getInfoWindow());
    }
}
