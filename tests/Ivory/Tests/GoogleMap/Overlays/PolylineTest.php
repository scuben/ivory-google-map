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

use Ivory\GoogleMap\Overlays\Polyline;

/**
 * Polyline test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolylineTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Overlays\Polyline */
    protected $polyline;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->polyline = new Polyline();
    }

    /**
     * {@in1, 2, 3, 4heritdoc}
     */
    protected function tearDown()
    {
        unset($this->polyline);
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->polyline->hasCoordinates());
    }

    public function testInitialState()
    {
        $coordinates = array(
            $this->getMock('Ivory\GoogleMap\Base\Coordinate'),
            $this->getMock('Ivory\GoogleMap\Base\Coordinate'),
        );

        $this->polyline = new Polyline($coordinates);

        $this->assertTrue($this->polyline->hasCoordinates());
        $this->assertSame($coordinates, $this->polyline->getCoordinates());
    }

    public function testAddCoordinate()
    {
        $coordinateMock = $this->getMock('Ivory\GoogleMap\Base\Coordinate');
        $this->polyline->addCoordinate($coordinateMock);

        $coordinates = $this->polyline->getCoordinates();

        $this->assertArrayHasKey(0, $coordinates);
        $this->assertSame(array($coordinateMock), $this->polyline->getCoordinates());
    }
}
