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

    public function testMapTypeControl()
    {
        $mapTypeControl = $this->getMock('Ivory\GoogleMap\Controls\MapTypeControl');
        $this->controls->setMapTypeControl($mapTypeControl);

        $this->assertTrue($this->controls->hasMapTypeControl());
        $this->assertSame($mapTypeControl, $this->controls->getMapTypeControl());
    }

    public function testMapTypeControlWithNullValue()
    {
        $this->controls->setMapTypeControl($this->getMock('Ivory\GoogleMap\Controls\MapTypeControl'));
        $this->controls->setMapTypeControl(null);

        $this->assertFalse($this->controls->hasMapTypeControl());
    }

    public function testOverviewMapControl()
    {
        $overviewMapControl = $this->getMock('Ivory\GoogleMap\Controls\OverviewMapControl');
        $this->controls->setOverviewMapControl($overviewMapControl);

        $this->assertTrue($this->controls->hasOverviewMapControl());
        $this->assertSame($overviewMapControl, $this->controls->getOverviewMapControl());
    }

    public function testOverviewMapControlWithNullValue()
    {
        $this->controls->setOverviewMapControl($this->getMock('Ivory\GoogleMap\Controls\OverviewMapControl'));
        $this->controls->setOverviewMapControl(null);

        $this->assertFalse($this->controls->hasOverviewMapControl());
    }

    public function testPanControl()
    {
        $panControl = $this->getMock('Ivory\GoogleMap\Controls\PanControl');
        $this->controls->setPanControl($panControl);

        $this->assertTrue($this->controls->hasPanControl());
        $this->assertSame($panControl, $this->controls->getPanControl());
    }

    public function testPanControlWithNullValue()
    {
        $this->controls->setPanControl($this->getMock('Ivory\GoogleMap\Controls\PanControl'));
        $this->controls->setPanControl(null);

        $this->assertFalse($this->controls->hasPanControl());
    }

    public function testRotateControl()
    {
        $rotateControl = $this->getMock('Ivory\GoogleMap\Controls\RotateControl');
        $this->controls->setRotateControl($rotateControl);

        $this->assertTrue($this->controls->hasRotateControl());
        $this->assertSame($rotateControl, $this->controls->getRotateControl());
    }

    public function testRotateControlWithNullValue()
    {
        $this->controls->setRotateControl($this->getMock('Ivory\GoogleMap\Controls\RotateControl'));
        $this->controls->setRotateControl(null);

        $this->assertFalse($this->controls->hasRotateControl());
    }

    public function testScaleControl()
    {
        $scaleControl = $this->getMock('Ivory\GoogleMap\Controls\ScaleControl');
        $this->controls->setScaleControl($scaleControl);

        $this->assertTrue($this->controls->hasScaleControl());
        $this->assertSame($scaleControl, $this->controls->getScaleControl());
    }

    public function testScaleControlWithNullValue()
    {
        $this->controls->setScaleControl($this->getMock('Ivory\GoogleMap\Controls\ScaleControl'));
        $this->controls->setScaleControl(null);

        $this->assertFalse($this->controls->hasScaleControl());
    }

    public function testStreetViewControl()
    {
        $streetViewControl = $this->getMock('Ivory\GoogleMap\Controls\StreetViewControl');
        $this->controls->setStreetViewControl($streetViewControl);

        $this->assertTrue($this->controls->hasStreetViewControl());
        $this->assertSame($streetViewControl, $this->controls->getStreetViewControl());
    }

    public function testStreetViewControlWithNullValue()
    {
        $this->controls->setStreetViewControl($this->getMock('Ivory\GoogleMap\Controls\StreetViewControl'));
        $this->controls->setStreetViewControl(null);

        $this->assertFalse($this->controls->hasStreetViewControl());
    }

    public function testZoomControl()
    {
        $zoomControl = $this->getMock('Ivory\GoogleMap\Controls\ZoomControl');
        $this->controls->setZoomControl($zoomControl);

        $this->assertTrue($this->controls->hasZoomControl());
        $this->assertSame($zoomControl, $this->controls->getZoomControl());
    }

    public function testZoomControlWithNullValue()
    {
        $this->controls->setZoomControl($this->getMock('Ivory\GoogleMap\Controls\ZoomControl'));
        $this->controls->setZoomControl(null);

        $this->assertFalse($this->controls->hasZoomControl());
    }
}
