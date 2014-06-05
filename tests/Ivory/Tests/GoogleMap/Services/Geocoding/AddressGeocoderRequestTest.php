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

use Ivory\GoogleMap\Services\Geocoding\AddressGeocoderRequest;

/**
 * Address geocoder request test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AddressGeocoderRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Services\Geocoding\AddressGeocoderRequest */
    protected $geocoderRequest;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->geocoderRequest = new AddressGeocoderRequest('');
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
        $this->assertFalse($this->geocoderRequest->hasAddress());
    }

    public function testAddressWithValidValue()
    {
        $this->geocoderRequest->setAddress('foo');

        $this->assertTrue($this->geocoderRequest->hasAddress());
        $this->assertSame('foo', $this->geocoderRequest->getAddress());
    }

    public function testAddressWithNullValue()
    {
        $this->geocoderRequest->setAddress('foo');
        $this->geocoderRequest->setAddress(null);

        $this->assertNull($this->geocoderRequest->getAddress());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\GeocodingException
     * @expectedExceptionMessage The geocoder request address must be a string value.
     */
    public function testAddressWithInvalidValue()
    {
        $this->geocoderRequest->setAddress(true);
    }

    public function testIsValidWithAddress()
    {
        $this->geocoderRequest->setAddress('address');

        $this->assertTrue($this->geocoderRequest->isValid());
    }
}
