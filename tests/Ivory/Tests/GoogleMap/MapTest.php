<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap;

use Ivory\GoogleMap\Map;

/**
 * Map test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Map */
    protected $map;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->map = new Map();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->map);
    }

    public function testDefaultState()
    {
        $this->assertSame('map_canvas', $this->map->getHtmlContainerId());
        $this->assertFalse($this->map->isAsync());
        $this->assertFalse($this->map->isAutoZoom());

        $this->assertInstanceOf('Ivory\GoogleMap\Base\Coordinate', $this->map->getCenter());
        $this->assertSame(0, $this->map->getCenter()->getLatitude());
        $this->assertSame(0, $this->map->getCenter()->getLongitude());
        $this->assertTrue($this->map->getCenter()->isNoWrap());

        $this->assertNull($this->map->getBound()->getNorthEast());
        $this->assertNull($this->map->getBound()->getSouthWest());
        $this->assertEmpty($this->map->getBound()->getExtends());

        $this->assertSame(array('mapTypeId' => 'roadmap','zoom' => 3), $this->map->getMapOptions());
        $this->assertSame(array('width' => '300px', 'height' => '300px'), $this->map->getStylesheetOptions());

        $this->assertInstanceOf('Ivory\GoogleMap\Controls\Controls', $this->map->getControls());
        $this->assertInstanceOf('Ivory\GoogleMap\Overlays\Overlays', $this->map->getOverlays());
        $this->assertInstanceOf('Ivory\GoogleMap\Layers\Layers', $this->map->getLayers());
        $this->assertInstanceOf('Ivory\GoogleMap\Events\Events', $this->map->getEvents());

        $this->assertSame($this->map, $this->map->getOverlays()->getMap());

        $this->assertFalse($this->map->hasLibraries());
        $this->assertSame('en', $this->map->getLanguage());
    }

    public function testHtmlContainerIdWithValidValue()
    {
        $this->map->setHtmlContainerId('html_container_id');

        $this->assertSame('html_container_id', $this->map->getHtmlContainerId());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\MapException
     * @expectedExceptionMessage The html container id of a map must be a string value.
     */
    public function testHtmlContainerWithInvalidValue()
    {
        $this->map->setHtmlContainerId(true);
    }

    public function testAsyncWithValidValue()
    {
        $this->map->setAsync(true);

        $this->assertTrue($this->map->isAsync());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\MapException
     * @expectedExceptionMessage The asynchronous load of a map must be a boolean value.
     */
    public function testAsyncWithInvalidValue()
    {
        $this->map->setAsync('foo');
    }

    public function testAutoZoomWithValidValue()
    {
        $this->map->setAutoZoom(true);

        $this->assertTrue($this->map->isAutoZoom());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\MapException
     * @expectedExceptionMessage The auto zoom of a map must be a boolean value.
     */
    public function testAutoZoomWithInvalidValue()
    {
        $this->map->setAutoZoom('foo');
    }

    public function testCenterWithCoordinate()
    {
        $coordinate = $this->getMock('Ivory\GoogleMap\Base\Coordinate');
        $this->map->setCenter($coordinate);

        $this->assertSame($coordinate, $this->map->getCenter());
    }

    public function testCenterWithLatitueAndLongitude()
    {
        $this->map->setCenter(1, 2, false);

        $this->assertEquals(1, $this->map->getCenter()->getLatitude());
        $this->assertEquals(2, $this->map->getCenter()->getLongitude());
        $this->assertFalse($this->map->getCenter()->isNoWrap());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\MapException
     * @expectedExceptionMessage The center setter arguments is invalid.
     * The available prototypes are :
     * - function setCenter(Ivory\GoogleMap\Base\Coordinate $center)
     * - function setCenter(double $latitude, double $longitude, boolean $noWrap = true)
     */
    public function testCenterWithInvalidValue()
    {
        $this->map->setCenter('foo');
    }

    public function testBoundWithBound()
    {
        $bound = $this->getMock('Ivory\GoogleMap\Base\Bound');
        $this->map->setBound($bound);

        $this->assertSame($bound, $this->map->getBound());
    }

    public function testBoundWithCoordinates()
    {
        $southWestCoordinate = $this->getMock('Ivory\GoogleMap\Base\Coordinate');
        $northEastCoordinate = $this->getMock('Ivory\GoogleMap\Base\Coordinate');

        $this->map->setBound($southWestCoordinate, $northEastCoordinate);

        $this->assertSame($southWestCoordinate, $this->map->getBound()->getSouthWest());
        $this->assertSame($northEastCoordinate, $this->map->getBound()->getNorthEast());
    }

    public function testBoundWithLatitudesAndLongitudes()
    {
        $this->map->setBound(1, 2, 3, 4, true, false);

        $this->assertSame(1, $this->map->getBound()->getSouthWest()->getLatitude());
        $this->assertSame(2, $this->map->getBound()->getSouthWest()->getLongitude());
        $this->assertTrue($this->map->getBound()->getSouthWest()->isNoWrap());

        $this->assertEquals(3, $this->map->getBound()->getNorthEast()->getLatitude());
        $this->assertEquals(4, $this->map->getBound()->getNorthEast()->getLongitude());
        $this->assertFalse($this->map->getBound()->getNorthEast()->isNoWrap());
    }

    public function testBoundWithNullValue()
    {
        $this->map->setBound(1, 2, 3, 4);
        $this->map->setBound(null);

        $this->assertNull($this->map->getBound()->getSouthWest());
        $this->assertNull($this->map->getBound()->getNorthEast());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\MapException
     * @expectedExceptionMessage The bound setter arguments is invalid.
     * The available prototypes are :
     * - function setBound(Ivory\GoogleMap\Base\Bound $bound)
     * - function setBount(Ivory\GoogleMap\Base\Coordinate $southWest, Ivory\GoogleMap\Base\Coordinate $northEast)
     * - function setBound(
     *     double $southWestLatitude,
     *     double $southWestLongitude,
     *     double $northEastLatitude,
     *     double $northEastLongitude,
     *     boolean southWestNoWrap = true,
     *     boolean $northEastNoWrap = true
     * )
     */
    public function testBoundWithInvalidValue()
    {
        $this->map->setBound('foo');
    }

    public function testHasMapOptionWithValidValue()
    {
        $this->assertTrue($this->map->hasMapOption('zoom'));
        $this->assertFalse($this->map->hasMapOption('foo'));
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\MapException
     * @expectedExceptionMessage The map option property of a map must be a string value.
     */
    public function testHasMapOptionWithInvalidValue()
    {
        $this->map->hasMapOption(true);
    }

    public function testSetMapOptionsWithValidValue()
    {
        $this->map->setMapOptions(array('foo' => 'bar'));

        $this->assertSame('bar', $this->map->getMapOption('foo'));
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\MapException
     */
    public function testSetMapOptionWithInvalidValue()
    {
        $this->map->setMapOption(true, false);
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\MapException
     */
    public function testGetMapOptionWithInvalidValue()
    {
        $this->map->getMapOption('foo');
    }

    public function testRemoveMapOptionWithValidValue()
    {
        $this->map->removeMapOption('zoom');

        $this->assertFalse($this->map->hasMapOption('zoom'));
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\MapException
     * @expectedExceptionMessage The map option "foo" does not exist.
     */
    public function testRemoveMapOptionWithInvalidValue()
    {
        $this->map->removeMapOption('foo');
    }

    public function testHasStylesheetOptionWithValidValue()
    {
        $this->assertTrue($this->map->hasStylesheetOption('width'));
        $this->assertFalse($this->map->hasStylesheetOption('foo'));
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\MapException
     * @expectedExceptionMessage The stylesheet option property of a map must be a string value.
     */
    public function testHasStylesheetOptionWithInvalidValue()
    {
        $this->map->hasStylesheetOption(true);
    }

    public function testSetStylesheetOptionsWithValidValue()
    {
        $this->map->setStylesheetOptions(array('foo' => 'bar'));

        $this->assertSame('bar', $this->map->getStylesheetOption('foo'));
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\MapException
     */
    public function testSetStylesheetOptionWithInvalidValue()
    {
        $this->map->setStylesheetOption(true, false);
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\MapException
     */
    public function testGetStylesheetOptionWithInvalidValue()
    {
        $this->map->getStylesheetOption('foo');
    }

    public function testRemoveStylesheetOptionWithValidValue()
    {
        $this->map->removeStylesheetOption('width');

        $this->assertFalse($this->map->hasStylesheetOption('width'));
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\MapException
     * @expectedExceptionMessage The stylesheet option "foo" does not exist.
     */
    public function testRemoveStylesheetOptionWithInvalidValue()
    {
        $this->map->removeStylesheetOption('foo');
    }

    public function testControls()
    {
        $controls = $this->getMock('Ivory\GoogleMap\Controls\Controls');
        $this->map->setControls($controls);

        $this->assertSame($controls, $this->map->getControls());
    }

    public function testOverlays()
    {
        $overlays = $this->getMockBuilder('Ivory\GoogleMap\Overlays\Overlays')
            ->disableOriginalConstructor()
            ->getMock();

        $overlays
            ->expects($this->once())
            ->method('setMap')
            ->with($this->equalTo($this->map));

        $this->map->setOverlays($overlays);

        $this->assertSame($overlays, $this->map->getOverlays());
    }

    public function testLayers()
    {
        $layers = $this->getMock('Ivory\GoogleMap\Layers\Layers');
        $this->map->setLayers($layers);

        $this->assertSame($layers, $this->map->getLayers());
    }

    public function testEvents()
    {
        $events = $this->getMock('Ivory\GoogleMap\Events\Events');
        $this->map->setEvents($events);

        $this->assertSame($events, $this->map->getEvents());
    }

    public function testLibraries()
    {
        $this->map->setLibraries(array('foo'));

        $this->assertTrue($this->map->hasLibraries());
        $this->assertSame(array('foo'), $this->map->getLibraries());
    }

    public function testLanguage()
    {
        $this->map->setLanguage('fr');

        $this->assertSame('fr', $this->map->getLanguage());
    }
}
