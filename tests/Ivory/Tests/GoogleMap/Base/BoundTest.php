<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Base;

use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;

/**
 * Bound test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class BoundTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Base\Bound */
    protected $bound;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->bound = new Bound();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->bound);
    }

    public function testDefaultState()
    {
        $this->assertSame('bound_', substr($this->bound->getJavascriptVariable(), 0, 6));
        $this->assertFalse($this->bound->hasCoordinates());
        $this->assertFalse($this->bound->hasExtends());
    }

    public function testInitialState()
    {
        $southWest = $this->getMock('Ivory\GoogleMap\Base\Coordinate');
        $northEast = $this->getMock('Ivory\GoogleMap\Base\Coordinate');
        $extends = array($this->getMock('Ivory\GoogleMap\Overlays\ExtendableInterface'));

        $this->bound = new Bound($southWest, $northEast, $extends);

        $this->assertTrue($this->bound->hasCoordinates());
        $this->assertSame($southWest, $this->bound->getSouthWest());
        $this->assertSame($northEast, $this->bound->getNorthEast());

        $this->assertTrue($this->bound->hasExtends());
        $this->assertSame($extends, $this->bound->getExtends());
    }

    public function testSouthWest()
    {
        $southWest = $this->getMock('Ivory\GoogleMap\Base\Coordinate');
        $this->bound->setSouthWest($southWest);

        $this->assertSame($southWest, $this->bound->getSouthWest());
    }

    public function testSouthWestWithNull()
    {
        $this->bound->setSouthWest($this->getMock('Ivory\GoogleMap\Base\Coordinate'));
        $this->bound->setSouthWest(null);

        $this->assertNull($this->bound->getSouthWest());
    }

    public function testNorthEast()
    {
        $northEast = $this->getMock('Ivory\GoogleMap\Base\Coordinate');
        $this->bound->setNorthEast($northEast);

        $this->assertSame($northEast, $this->bound->getNorthEast());
    }

    public function testNorthEastWithNull()
    {
        $this->bound->setNorthEast();
        $this->bound->setNorthEast(null);

        $this->assertNull($this->bound->getNorthEast());
    }

    public function testCenter()
    {
        $this->bound->setSouthWest(new Coordinate(-1, 0, false));
        $this->bound->setNorthEast(new Coordinate(1, 2, false));

        $center = $this->bound->getCenter();

        $this->assertSame(0, $center->getLatitude());
        $this->assertSame(1, $center->getLongitude());
        $this->assertTrue($center->isNoWrap());
    }
}
