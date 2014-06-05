<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Services\Geocoding;

use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Services\Geocoding\CoordinateGeocoderRequest;

/**
 * Coordinate geocoder request test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class CoordinateGeocoderRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Services\Geocoding\CoordinateGeocoderRequest */
    protected $geocoderRequest;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->geocoderRequest = new CoordinateGeocoderRequest(new Coordinate());
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->geocoderRequest);
    }

    public function testDefaultState()
    {
        $this->assertSame(
            'Ivory\\GoogleMap\\Services\\Geocoding\\AbstractGeocoderRequest',
            get_parent_class($this->geocoderRequest)
        );
        $this->assertTrue($this->geocoderRequest->hasCoordinate());
    }

    public function testCoordinate()
    {
        $coordinate = $this->getMock('Ivory\GoogleMap\Base\Coordinate');

        $this->geocoderRequest->setCoordinate($coordinate);

        $this->assertTrue($this->geocoderRequest->hasCoordinate());
        $this->assertSame($coordinate, $this->geocoderRequest->getCoordinate());
    }

    public function testCoordinateWithNullValue()
    {
        $this->geocoderRequest->setCoordinate($this->getMock('Ivory\GoogleMap\Base\Coordinate'));
        $this->geocoderRequest->setCoordinate(null);

        $this->assertNull($this->geocoderRequest->getCoordinate());
    }

    public function testIsValidWithCoordinate()
    {
        $this->assertTrue($this->geocoderRequest->isValid());
    }
}
