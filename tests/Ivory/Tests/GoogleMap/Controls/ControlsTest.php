<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Controls;

use Ivory\GoogleMap\Controls\Controls;
use Ivory\GoogleMap\Controls\ControlPosition;
use Ivory\GoogleMap\Controls\MapTypeControlStyle;
use Ivory\GoogleMap\Controls\ScaleControlStyle;
use Ivory\GoogleMap\Controls\ZoomControlStyle;
use Ivory\GoogleMap\MapTypeId;

/**
 * Controls test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ControlsTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Controls\Controls */
    protected $controls;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->controls = new Controls();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->controls);
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->controls->hasMapTypeControl());
        $this->assertFalse($this->controls->hasOverviewMapControl());
        $this->assertFalse($this->controls->hasPanControl());
        $this->assertFalse($this->controls->hasRotateControl());
        $this->assertFalse($this->controls->hasScaleControl());
        $this->assertFalse($this->controls->hasStreetViewControl());
        $this->assertFalse($this->controls->hasZoomControl());
    }

    public function testMapTypeControlWithMapTypeControl()
    {
        $mapTypeControl = $this->getMock('Ivory\GoogleMap\Controls\MapTypeControl');
        $this->controls->setMapTypeControl($mapTypeControl);

        $this->assertTrue($this->controls->hasMapTypeControl());
        $this->assertSame($mapTypeControl, $this->controls->getMapTypeControl());
    }

    public function testMapTypeControlWithMapTypeControlParameters()
    {
        $mapTypeIds = array(MapTypeId::TERRAIN);
        $controlPosition = ControlPosition::BOTTOM_CENTER;
        $mapTypeControlStyle = MapTypeControlStyle::HORIZONTAL_BAR;

        $this->controls->setMapTypeControl($mapTypeIds, $controlPosition, $mapTypeControlStyle);

        $this->assertTrue($this->controls->hasMapTypeControl());
        $this->assertSame($mapTypeIds, $this->controls->getMapTypeControl()->getMapTypeIds());
        $this->assertSame($controlPosition, $this->controls->getMapTypeControl()->getControlPosition());
        $this->assertSame($mapTypeControlStyle, $this->controls->getMapTypeControl()->getMapTypeControlStyle());
    }

    public function testMapTypeControlWithNullValue()
    {
        $this->controls->setMapTypeControl($this->getMock('Ivory\GoogleMap\Controls\MapTypeControl'));
        $this->controls->setMapTypeControl(null);

        $this->assertFalse($this->controls->hasMapTypeControl());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\ControlException
     * @expectedExceptionMessage The map type control setter arguments is invalid.
     * The available prototypes are :
     * - function setMapTypeControl(Ivory\GoogleMap\Controls\MapTypeControl $mapTypeControl = null)
     * - function setMaptypeControl(array $mapTypeIds, string $controlPosition, string $mapTypeControlStyle)
     */
    public function testMapTypeControlWithInvalidValue()
    {
        $this->controls->setMapTypeControl('foo');
    }

    public function testOverviewMapControlWithOverviewMapControl()
    {
        $overviewMapControl = $this->getMock('Ivory\GoogleMap\Controls\OverviewMapControl');
        $this->controls->setOverviewMapControl($overviewMapControl);

        $this->assertTrue($this->controls->hasOverviewMapControl());
        $this->assertSame($overviewMapControl, $this->controls->getOverviewMapControl());
    }

    public function testOverviewMapControlWithOverviewMapControlParameters()
    {
        $this->controls->setOverviewMapControl(true);

        $this->assertTrue($this->controls->hasOverviewMapControl());
        $this->assertTrue($this->controls->getOverviewMapControl()->isOpened());
    }

    public function testOverviewMapControlWithNullValue()
    {
        $this->controls->setOverviewMapControl($this->getMock('Ivory\GoogleMap\Controls\OverviewMapControl'));
        $this->controls->setOverviewMapControl(null);

        $this->assertFalse($this->controls->hasOverviewMapControl());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\ControlException
     * @expectedExceptionMessage The overview map control setter arguments is invalid.
     * The available prototypes are :
     * - function setOverviewMapControl(Ivory\GoogleMap\Controls\OverviewMapControl $overviewMapControl = null)
     * - function setOverviewMapControl(boolean $opened)
     */
    public function testOverviewMapControlWithInvalidValue()
    {
        $this->controls->setOverviewMapControl('foo');
    }

    public function testPanControlWithPanControl()
    {
        $panControl = $this->getMock('Ivory\GoogleMap\Controls\PanControl');
        $this->controls->setPanControl($panControl);

        $this->assertTrue($this->controls->hasPanControl());
        $this->assertSame($panControl, $this->controls->getPanControl());
    }

    public function testPanControlWithPanControlParameters()
    {
        $this->controls->setPanControl(ControlPosition::BOTTOM_CENTER);

        $this->assertTrue($this->controls->hasPanControl());
        $this->assertSame(ControlPosition::BOTTOM_CENTER, $this->controls->getPanControl()->getControlPosition());
    }

    public function testPanControlWithNullValue()
    {
        $this->controls->setPanControl($this->getMock('Ivory\GoogleMap\Controls\PanControl'));
        $this->controls->setPanControl(null);

        $this->assertFalse($this->controls->hasPanControl());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\ControlException
     * @expectedExceptionMessage The pan control setter arguments is invalid.
     * The available prototypes are :
     * - function setPanControl(Ivory\GoogleMap\Controls\PanControl $panControl = null)
     * - function setPanControl(string $controlPosition)
     */
    public function testPanControlWithInvalidValue()
    {
        $this->controls->setPanControl(true);
    }

    public function testRotateControlWithRotateControl()
    {
        $rotateControl = $this->getMock('Ivory\GoogleMap\Controls\RotateControl');
        $this->controls->setRotateControl($rotateControl);

        $this->assertTrue($this->controls->hasRotateControl());
        $this->assertSame($rotateControl, $this->controls->getRotateControl());
    }

    public function testRotateControlWithRotateControlParameters()
    {
        $this->controls->setRotateControl(ControlPosition::BOTTOM_CENTER);

        $this->assertTrue($this->controls->hasRotateControl());
        $this->assertSame(ControlPosition::BOTTOM_CENTER, $this->controls->getRotateControl()->getControlPosition());
    }

    public function testRotateControlWithNullValue()
    {
        $this->controls->setRotateControl($this->getMock('Ivory\GoogleMap\Controls\RotateControl'));
        $this->controls->setRotateControl(null);

        $this->assertFalse($this->controls->hasRotateControl());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\ControlException
     * @expectedExceptionMessage The rotate control setter arguments is invalid.
     * The available prototypes are :
     * - function setRotateControl(Ivory\GoogleMap\Controls\RotateControl $rotateControl = null)
     * - function setRotateControl(string $controlPosition)
     */
    public function testRotateControlWithInvalidValue()
    {
        $this->controls->setRotateControl(true);
    }

    public function testScaleControlWithScaleControl()
    {
        $scaleControl = $this->getMock('Ivory\GoogleMap\Controls\ScaleControl');
        $this->controls->setScaleControl($scaleControl);

        $this->assertTrue($this->controls->hasScaleControl());
        $this->assertSame($scaleControl, $this->controls->getScaleControl());
    }

    public function testScaleControlWithScaleControlParameters()
    {
        $this->controls->setScaleControl(ControlPosition::BOTTOM_CENTER, ScaleControlStyle::DEFAULT_);

        $this->assertSame(ControlPosition::BOTTOM_CENTER, $this->controls->getScaleControl()->getControlPosition());
        $this->assertSame(ScaleControlStyle::DEFAULT_, $this->controls->getScaleControl()->getScaleControlStyle());

        $this->assertTrue($this->controls->hasScaleControl());
    }

    public function testScaleControlWithNullValue()
    {
        $this->controls->setScaleControl($this->getMock('Ivory\GoogleMap\Controls\ScaleControl'));
        $this->controls->setScaleControl(null);

        $this->assertFalse($this->controls->hasScaleControl());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\ControlException
     * @expectedExceptionMessage The scale control setter arguments is invalid.
     * The available prototypes are :
     * - function setScaleControl(Ivory\GoogleMap\Controls\ScaleControl $scaleControl = null)
     * - function setScaleControl(string $controlPosition, string $scaleControlStyle)
     */
    public function testScaleControlWithInvalidValue()
    {
        $this->controls->setScaleControl(true);
    }

    public function testStreetViewControlWithStreetViewControl()
    {
        $streetViewControl = $this->getMock('Ivory\GoogleMap\Controls\StreetViewControl');
        $this->controls->setStreetViewControl($streetViewControl);

        $this->assertTrue($this->controls->hasStreetViewControl());
        $this->assertSame($streetViewControl, $this->controls->getStreetViewControl());
    }

    public function testStreetViewControlWithStreetViewControlParameters()
    {
        $this->controls->setStreetViewControl(ControlPosition::BOTTOM_CENTER);

        $this->assertTrue($this->controls->hasStreetViewControl());

        $this->assertSame(
            ControlPosition::BOTTOM_CENTER,
            $this->controls->getStreetViewControl()->getControlPosition()
        );
    }

    public function testStreetViewControlWithNullValue()
    {
        $this->controls->setStreetViewControl($this->getMock('Ivory\GoogleMap\Controls\StreetViewControl'));
        $this->controls->setStreetViewControl(null);

        $this->assertFalse($this->controls->hasStreetViewControl());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\ControlException
     * @expectedExceptionMessage The street view control setter arguments is invalid.
     * The available prototypes are :
     * - function setStreetViewControl(Ivory\GoogleMap\Controls\StreetViewControl $streetViewControl = null)
     * - function setStreetViewControl(string $controlPosition)
     */
    public function testStreetViewControlWithInvalidValue()
    {
        $this->controls->setStreetViewControl(true);
    }

    public function testZoomControlWithZoomControl()
    {
        $zoomControl = $this->getMock('Ivory\GoogleMap\Controls\ZoomControl');
        $this->controls->setZoomControl($zoomControl);

        $this->assertTrue($this->controls->hasZoomControl());
        $this->assertSame($zoomControl, $this->controls->getZoomControl());
    }

    public function testZoomControlWithZoomControlParameters()
    {
        $this->controls->setZoomControl(ControlPosition::BOTTOM_CENTER, ZoomControlStyle::LARGE);

        $this->assertTrue($this->controls->hasZoomControl());
        $this->assertSame(ControlPosition::BOTTOM_CENTER, $this->controls->getZoomControl()->getControlPosition());
        $this->assertSame(ZoomControlStyle::LARGE, $this->controls->getZoomControl()->getZoomControlStyle());
    }

    public function testZoomControlWithNullValue()
    {
        $this->controls->setZoomControl($this->getMock('Ivory\GoogleMap\Controls\ZoomControl'));
        $this->controls->setZoomControl(null);

        $this->assertFalse($this->controls->hasZoomControl());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\ControlException
     * @expectedExceptionMessage The zoom control setter arguments is invalid.
     * The available prototypes are :
     * - function setZoomControl(Ivory\GoogleMap\Controls\ZoomControl $zoomControl = null)
     * - function setZoomControl(string $controlPosition, string $zoomControlStyle)
     */
    public function testZoomControlWithInvalidValue()
    {
        $this->controls->setZoomControl(true);
    }
}
