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

/**
 * Abstract geocoder request test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AbstractGeocoderRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Services\Geocoding\AbstractGeocoderRequest */
    protected $geocoderRequest;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->geocoderRequest = $this
            ->getMockBuilder('Ivory\GoogleMap\Services\Geocoding\AbstractGeocoderRequest')
            ->getMockForAbstractClass();
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
        $this->assertFalse($this->geocoderRequest->hasBound());
        $this->assertFalse($this->geocoderRequest->hasRegion());
        $this->assertFalse($this->geocoderRequest->hasLanguage());
        $this->assertFalse($this->geocoderRequest->hasSensor());
    }

    public function testBound()
    {
        $bound = $this->getMock('Ivory\GoogleMap\Base\Bound');
        $this->geocoderRequest->setBound($bound);

        $this->assertTrue($this->geocoderRequest->hasBound());
        $this->assertSame($bound, $this->geocoderRequest->getBound());
    }

    public function testBoundWithNullValue()
    {
        $this->geocoderRequest->setBound($this->getMock('Ivory\GoogleMap\Base\Bound'));
        $this->geocoderRequest->setBound(null);

        $this->assertNull($this->geocoderRequest->getBound());
    }

    public function testRegionWithValidValue()
    {
        $this->geocoderRequest->setRegion('fr');

        $this->assertTrue($this->geocoderRequest->hasRegion());
        $this->assertSame('fr', $this->geocoderRequest->getRegion());
    }

    public function testRegionWithNullValue()
    {
        $this->geocoderRequest->setRegion('fr');
        $this->geocoderRequest->setRegion(null);

        $this->assertNull($this->geocoderRequest->getRegion());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\GeocodingException
     * @expectedExceptionMessage The geocoder request region must be a string with two characters.
     */
    public function testRegionWithInvalidValue()
    {
        $this->geocoderRequest->setRegion('foo');
    }

    public function testLanguageWithValidValue()
    {
        $this->geocoderRequest->setLanguage('pl');

        $this->assertTrue($this->geocoderRequest->hasLanguage());
        $this->assertSame('pl', $this->geocoderRequest->getLanguage());
    }

    public function testLanguageWithNullValue()
    {
        $this->geocoderRequest->setLanguage('pl');
        $this->geocoderRequest->setLanguage(null);

        $this->assertNull($this->geocoderRequest->getLanguage());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\GeocodingException
     * @expectedExceptionMessage The geocoder request language must be a string with two or five characters.
     */
    public function testLanguageWithInvalidValue()
    {
        $this->geocoderRequest->setLanguage('foo');
    }

    public function testSensorWithValidValue()
    {
        $this->geocoderRequest->setSensor(true);

        $this->assertTrue($this->geocoderRequest->hasSensor());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\GeocodingException
     * @expectedExceptionMessage The geocoder request sensor flag must be a boolean value.
     */
    public function testSensorWithInvalidValue()
    {
        $this->geocoderRequest->setSensor('foo');
    }
}
