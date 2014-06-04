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

use Ivory\GoogleMap\Overlays\Overlays;

/**
 * Overlays test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class OverlaysTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Overlays\Overlays */
    protected $overlays;

    /** @var \Ivory\GoogleMap\Map */
    protected $map;

    /** @var \Ivory\GoogleMap\Base\Bound */
    protected $bound;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->bound = $this->getMock('Ivory\GoogleMap\Base\Bound');

        $this->map = $this->getMock('Ivory\GoogleMap\Map');
        $this->map
            ->expects($this->any())
            ->method('getBound')
            ->will($this->returnValue($this->bound));

        $this->overlays = new Overlays($this->map);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->bound);
        unset($this->map);
        unset($this->overlays);
    }

    public function testDefaultState()
    {
        $this->assertSame($this->map, $this->overlays->getMap());

        $this->assertInstanceOf('Ivory\GoogleMap\Overlays\MarkerCluster', $this->overlays->getMarkerCluster());

        $this->assertFalse($this->overlays->hasMarkers());
        $this->assertFalse($this->overlays->hasInfoWindows());
        $this->assertFalse($this->overlays->hasPolylines());
        $this->assertFalse($this->overlays->hasPolygons());
        $this->assertFalse($this->overlays->hasEncodedPolylines());
        $this->assertFalse($this->overlays->hasRectangles());
        $this->assertFalse($this->overlays->hasCircles());
        $this->assertFalse($this->overlays->hasGroundOverlays());
    }

    public function testMap()
    {
        $map = $this->getMock('Ivory\GoogleMap\Map');

        $map
            ->expects($this->once())
            ->method('getOverlays')
            ->will($this->returnValue(null));

        $map
            ->expects($this->once())
            ->method('setOverlays')
            ->with($this->overlays);

        $this->overlays->setMap($map);
    }

    public function testMarkerCluster()
    {
        $markerCluster = $this->getMock('Ivory\GoogleMap\Overlays\MarkerCluster');
        $this->overlays->setMarkerCluster($markerCluster);

        $this->assertSame($markerCluster, $this->overlays->getMarkerCluster());
    }

    public function testMarkerWithoutAutoZoom()
    {
        $marker = $this->getMock('Ivory\GoogleMap\Overlays\Marker');

        $this->bound
            ->expects($this->never())
            ->method('extend');

        $this->overlays->addMarker($marker);

        $this->assertTrue($this->overlays->hasMarkers());
        $this->assertSame(array($marker), $this->overlays->getMarkers());
    }

    public function testMarkerWithAutoZoom()
    {
        $this->map
            ->expects($this->any())
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $marker = $this->getMock('Ivory\GoogleMap\Overlays\Marker');

        $this->bound
            ->expects($this->once())
            ->method('extend')
            ->with($this->equalTo($marker));

        $this->overlays->addMarker($marker);

        $this->assertTrue($this->overlays->hasMarkers());
        $this->assertSame(array($marker), $this->overlays->getMarkers());
    }

    public function testInfoWindowWithoutAutoZoom()
    {
        $infoWindow = $this->getMock('Ivory\GoogleMap\Overlays\InfoWindow');

        $this->bound
            ->expects($this->never())
            ->method('extend');

        $this->overlays->addInfoWindow($infoWindow);

        $this->assertTrue($this->overlays->hasInfoWindows());
        $this->assertSame(array($infoWindow), $this->overlays->getInfoWindows());
    }

    public function testInfoWindowWithAutoZoom()
    {
        $this->map
            ->expects($this->any())
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $infoWindow = $this->getMock('Ivory\GoogleMap\Overlays\InfoWindow');

        $this->bound
            ->expects($this->once())
            ->method('extend')
            ->with($this->equalTo($infoWindow));

        $this->overlays->addInfoWindow($infoWindow);

        $this->assertTrue($this->overlays->hasInfoWindows());
        $this->assertSame(array($infoWindow), $this->overlays->getInfoWindows());
    }

    public function testPolylineWithoutAutoZoom()
    {
        $polyline = $this->getMock('Ivory\GoogleMap\Overlays\Polyline');

        $this->bound
            ->expects($this->never())
            ->method('extend');

        $this->overlays->addPolyline($polyline);

        $this->assertTrue($this->overlays->hasPolylines());
        $this->assertSame(array($polyline), $this->overlays->getPolylines());
    }

    public function testPolylineWithAutoZoom()
    {
        $this->map
            ->expects($this->any())
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $polyline = $this->getMock('Ivory\GoogleMap\Overlays\Polyline');

        $this->bound
            ->expects($this->once())
            ->method('extend')
            ->with($this->equalTo($polyline));

        $this->overlays->addPolyline($polyline);

        $this->assertTrue($this->overlays->hasPolylines());
        $this->assertSame(array($polyline), $this->overlays->getPolylines());
    }

    public function testEncodedPolylineWithoutAutoZoom()
    {
        $encodedPolyline = $this->getMock('Ivory\GoogleMap\Overlays\EncodedPolyline');

        $this->bound
            ->expects($this->never())
            ->method('extend');

        $this->overlays->addEncodedPolyline($encodedPolyline);

        $this->assertTrue($this->overlays->hasEncodedPolylines());
        $this->assertSame(array($encodedPolyline), $this->overlays->getEncodedPolylines());
    }

    public function testEncodedPolylineWithAutoZoom()
    {
        $this->map
            ->expects($this->any())
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $encodedPolyline = $this->getMock('Ivory\GoogleMap\Overlays\EncodedPolyline');

        $this->bound
            ->expects($this->once())
            ->method('extend')
            ->with($this->equalTo($encodedPolyline));

        $this->overlays->addEncodedPolyline($encodedPolyline);

        $this->assertTrue($this->overlays->hasEncodedPolylines());
        $this->assertSame(array($encodedPolyline), $this->overlays->getEncodedPolylines());
    }

    public function testPolygonWithoutAutoZoom()
    {
        $polygon = $this->getMock('Ivory\GoogleMap\Overlays\Polygon');

        $this->bound
            ->expects($this->never())
            ->method('extend');

        $this->overlays->addPolygon($polygon);

        $this->assertTrue($this->overlays->hasPolygons());
        $this->assertSame(array($polygon), $this->overlays->getPolygons());
    }

    public function testPolygonWithAutoZoom()
    {
        $this->map
            ->expects($this->any())
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $polygon = $this->getMock('Ivory\GoogleMap\Overlays\Polygon');

        $this->bound
            ->expects($this->once())
            ->method('extend')
            ->with($this->equalTo($polygon));

        $this->overlays->addPolygon($polygon);

        $this->assertTrue($this->overlays->hasPolygons());
        $this->assertSame(array($polygon), $this->overlays->getPolygons());
    }

    public function testRectangleWithoutAutoZoom()
    {
        $rectangle = $this->getMock('Ivory\GoogleMap\Overlays\Rectangle');

        $this->bound
            ->expects($this->never())
            ->method('extend');

        $this->overlays->addRectangle($rectangle);

        $this->assertTrue($this->overlays->hasRectangles());
        $this->assertSame(array($rectangle), $this->overlays->getRectangles());
    }

    public function testRectangleWithAutoZoom()
    {
        $this->map
            ->expects($this->any())
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $rectangle = $this->getMock('Ivory\GoogleMap\Overlays\Rectangle');

        $this->bound
            ->expects($this->once())
            ->method('extend')
            ->with($this->equalTo($rectangle));

        $this->overlays->addRectangle($rectangle);

        $this->assertTrue($this->overlays->hasRectangles());
        $this->assertSame(array($rectangle), $this->overlays->getRectangles());
    }

    public function testCircleWithoutAutoZoom()
    {
        $circle = $this->getMock('Ivory\GoogleMap\Overlays\Circle');

        $this->bound
            ->expects($this->never())
            ->method('extend');

        $this->overlays->addCircle($circle);

        $this->assertTrue($this->overlays->hasCircles());
        $this->assertSame(array($circle), $this->overlays->getCircles());
    }

    public function testCircleWithAutoZoom()
    {
        $this->map
            ->expects($this->any())
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $circle = $this->getMock('Ivory\GoogleMap\Overlays\Circle');

        $this->bound
            ->expects($this->once())
            ->method('extend')
            ->with($this->equalTo($circle));

        $this->overlays->addCircle($circle);

        $this->assertTrue($this->overlays->hasCircles());
        $this->assertSame(array($circle), $this->overlays->getCircles());
    }

    public function testGroundOverlayWithoutAutoZoom()
    {
        $groundOverlay = $this->getMock('Ivory\GoogleMap\Overlays\GroundOverlay');

        $this->bound
            ->expects($this->never())
            ->method('extend');

        $this->overlays->addGroundOverlay($groundOverlay);

        $this->assertTrue($this->overlays->hasGroundOverlays());
        $this->assertSame(array($groundOverlay), $this->overlays->getGroundOverlays());
    }

    public function testGroundOverlayWithAutoZoom()
    {
        $this->map
            ->expects($this->any())
            ->method('isAutoZoom')
            ->will($this->returnValue(true));

        $groundOverlay = $this->getMock('Ivory\GoogleMap\Overlays\GroundOverlay');

        $this->bound
            ->expects($this->once())
            ->method('extend')
            ->with($this->equalTo($groundOverlay));

        $this->overlays->addGroundOverlay($groundOverlay);

        $this->assertTrue($this->overlays->hasGroundOverlays());
        $this->assertSame(array($groundOverlay), $this->overlays->getGroundOverlays());
    }
}
