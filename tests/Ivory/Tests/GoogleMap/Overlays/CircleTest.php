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

use Ivory\GoogleMap\Overlays\Circle;

/**
 * Circle test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class CircleTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Overlays\Circle */
    protected $circle;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->circle = new Circle();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->circle);
    }

    public function testDefaultState()
    {
        $this->assertInstanceOf('Ivory\GoogleMap\Base\Coordinate', $this->circle->getCenter());
        $this->assertSame(1, $this->circle->getRadius());
    }

    public function testInitialState()
    {
        $center = $this->getMock('Ivory\GoogleMap\Base\Coordinate');
        $radius = 2;

        $this->circle = new Circle($center, $radius);

        $this->assertSame($center, $this->circle->getCenter());
        $this->assertSame($radius, $this->circle->getRadius());
    }

    public function testCenter()
    {
        $center = $this->getMock('Ivory\GoogleMap\Base\Coordinate');
        $this->circle->setCenter($center);

        $this->assertSame($center, $this->circle->getCenter());
    }

    public function testRadiusWithValidValue()
    {
        $this->circle->setRadius(3);

        $this->assertSame(3, $this->circle->getRadius());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\OverlayException
     * @expectedExceptionMessage The radius of a circle must be a numeric value.
     */
    public function testRadiusWithInvalidValue()
    {
        $this->circle->setRadius(true);
    }
}
