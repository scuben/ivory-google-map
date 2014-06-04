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

use Ivory\GoogleMap\Overlays\Rectangle;

/**
 * Rectangle test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class RectangleTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Overlays\Rectangle */
    protected $rectangle;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->rectangle = new Rectangle();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->rectangle);
    }

    public function testDefaultState()
    {
        $this->assertSame(1, $this->rectangle->getBound()->getNorthEast()->getLatitude());
        $this->assertSame(1, $this->rectangle->getBound()->getNorthEast()->getLongitude());
        $this->assertTrue($this->rectangle->getBound()->getNorthEast()->isNoWrap());

        $this->assertSame(-1, $this->rectangle->getBound()->getSouthWest()->getLatitude());
        $this->assertSame(-1, $this->rectangle->getBound()->getSouthWest()->getLongitude());
        $this->assertTrue($this->rectangle->getBound()->getSouthWest()->isNoWrap());
    }

    public function testInitialState()
    {
        $bound = $this->getMock('Ivory\GoogleMap\Base\Bound');
        $bound
            ->expects($this->once())
            ->method('hasCoordinates')
            ->will($this->returnValue(true));

        $this->rectangle = new Rectangle($bound);

        $this->assertSame($bound, $this->rectangle->getBound());
    }

    public function testBound()
    {
        $bound = $this->getMock('Ivory\GoogleMap\Base\Bound');
        $bound
            ->expects($this->once())
            ->method('hasCoordinates')
            ->will($this->returnValue(true));

        $this->rectangle->setBound($bound);

        $this->assertSame($bound, $this->rectangle->getBound());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\OverlayException
     * @expectedExceptionMessage A rectangle bound must have a south west & a north east coordinate.
     */
    public function testBoundWithInvalidBound()
    {
        $this->rectangle->setBound($this->getMock('Ivory\GoogleMap\Base\Bound'));
    }
}
