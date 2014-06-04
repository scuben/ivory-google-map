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

use Ivory\GoogleMap\Overlays\Polygon;

/**
 * Polygon test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PolygonTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Overlays\Polygon */
    protected $polygon;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->polygon = new Polygon();
    }

    /**
     * {@in1, 2, 3, 4heritdoc}
     */
    protected function tearDown()
    {
        unset($this->polygon);
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->polygon->hasCoordinates());
    }

    public function testInitialState()
    {
        $coordinates = array(
            $this->getMock('Ivory\GoogleMap\Base\Coordinate'),
            $this->getMock('Ivory\GoogleMap\Base\Coordinate'),
        );

        $this->polygon = new Polygon($coordinates);

        $this->assertTrue($this->polygon->hasCoordinates());
        $this->assertSame($coordinates, $this->polygon->getCoordinates());
    }

    public function testAddCoordinate()
    {
        $coordinateMock = $this->getMock('Ivory\GoogleMap\Base\Coordinate');
        $this->polygon->addCoordinate($coordinateMock);

        $coordinates = $this->polygon->getCoordinates();

        $this->assertArrayHasKey(0, $coordinates);
        $this->assertSame(array($coordinateMock), $this->polygon->getCoordinates());
    }
}
