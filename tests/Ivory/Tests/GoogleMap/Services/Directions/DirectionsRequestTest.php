<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Services\Directions;

use \DateTime;
use Ivory\GoogleMap\Services\Directions\DirectionsRequest;
use Ivory\GoogleMap\Services\Base\TravelMode;
use Ivory\GoogleMap\Services\Base\UnitSystem;

/**
 * Directions request test.
 *
 * @author GeLo <gelon.eric@gmail.com>
 */
class DirectionsRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Services\Directions\DirectionsRequest */
    protected $directionsRequest;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->directionsRequest = new DirectionsRequest('', '');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->directionsRequest);
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->directionsRequest->hasAvoidHighways());
        $this->assertFalse($this->directionsRequest->hasAvoidTolls());
        $this->assertFalse($this->directionsRequest->hasDestination());
        $this->assertFalse($this->directionsRequest->hasOptimizeWaypoints());
        $this->assertFalse($this->directionsRequest->hasOrigin());
        $this->assertFalse($this->directionsRequest->hasDepartureTime());
        $this->assertFalse($this->directionsRequest->hasArrivalTime());
        $this->assertFalse($this->directionsRequest->hasProvideRouteAlternatives());
        $this->assertFalse($this->directionsRequest->hasRegion());
        $this->assertFalse($this->directionsRequest->hasLanguage());
        $this->assertFalse($this->directionsRequest->hasTravelMode());
        $this->assertFalse($this->directionsRequest->hasUnitSystem());
        $this->assertFalse($this->directionsRequest->hasWaypoints());
    }

    public function testAvoidHightwaysWithValidValue()
    {
        $this->directionsRequest->setAvoidHighways(true);

        $this->assertTrue($this->directionsRequest->hasAvoidHighways());
        $this->assertTrue($this->directionsRequest->getAvoidHighways());
    }

    public function testAvoidHighwaysWithNullValue()
    {
        $this->directionsRequest->setAvoidHighways(true);
        $this->directionsRequest->setAvoidHighways(null);

        $this->assertNull($this->directionsRequest->getAvoidHighways());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\DirectionsException
     * @expectedExceptionMessage The directions request avoid hightways flag must be a boolean value.
     */
    public function testAvoidHighwaysWithInvalidValue()
    {
        $this->directionsRequest->setAvoidHighways('foo');
    }

    public function testAvoidTollsWithValidValue()
    {
        $this->directionsRequest->setAvoidTolls(true);

        $this->assertTrue($this->directionsRequest->hasAvoidTolls());
        $this->assertTrue($this->directionsRequest->getAvoidTolls());
    }

    public function testAvoidTollsWithNullValue()
    {
        $this->directionsRequest->setAvoidTolls(true);
        $this->directionsRequest->setAvoidTolls(null);

        $this->assertNull($this->directionsRequest->getAvoidTolls());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\DirectionsException
     * @expectedExceptionMessage The directions request avoid tolls flag must be a boolean value.
     */
    public function testAvoidTollsWithInvalidValue()
    {
        $this->directionsRequest->setAvoidTolls('foo');
    }

    public function testDestinationWithString()
    {
        $this->directionsRequest->setDestination('foo');

        $this->assertTrue($this->directionsRequest->hasDestination());
        $this->assertEquals($this->directionsRequest->getDestination(), 'foo');
    }

    public function testDestination()
    {
        $location = $this->getMock('Ivory\GoogleMap\Base\Coordinate');

        $this->directionsRequest->setDestination($location);

        $this->assertSame($location, $this->directionsRequest->getDestination());
    }

    public function testOptimizeWaypointsWithValidValue()
    {
        $this->directionsRequest->setOptimizeWaypoints(true);

        $this->assertTrue($this->directionsRequest->hasOptimizeWaypoints());
        $this->assertTrue($this->directionsRequest->getOptimizeWaypoints());
    }

    public function testOptimizeWaypointsWithNullValue()
    {
        $this->directionsRequest->setOptimizeWaypoints(true);
        $this->directionsRequest->setOptimizeWaypoints(null);

        $this->assertNull($this->directionsRequest->getOptimizeWaypoints());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\DirectionsException
     * @expectedExceptionMessage The directions request optimize waypoints flag must be a boolean value.
     */
    public function testOptimizeWaypointsWithInvalidValue()
    {
        $this->directionsRequest->setOptimizeWaypoints('foo');
    }

    public function testOrigin()
    {
        $origin = $this->getMock('Ivory\GoogleMap\Base\Coordinate');
        $this->directionsRequest->setOrigin($origin);

        $this->assertSame($origin, $this->directionsRequest->getOrigin());
    }

    public function testDepartureTimeWithValidValue()
    {
        $now = new DateTime();
        $this->directionsRequest->setDepartureTime($now);

        $this->assertTrue($this->directionsRequest->hasDepartureTime());
        $this->assertSame($now, $this->directionsRequest->getDepartureTime());
    }

    public function testDepartureTimeWithNullValue()
    {
        $this->directionsRequest->setDepartureTime(new DateTime());
        $this->directionsRequest->setDepartureTime(null);

        $this->assertNull($this->directionsRequest->getDepartureTime());
    }

    public function testArrivalTimeWithValidValue()
    {
        $now = new DateTime();
        $this->directionsRequest->setArrivalTime($now);

        $this->assertTrue($this->directionsRequest->hasArrivalTime());
        $this->assertSame($now, $this->directionsRequest->getArrivalTime());
    }

    public function testArrivalTimeWithNullValue()
    {
        $this->directionsRequest->setArrivalTime(new DateTime());
        $this->directionsRequest->setArrivalTime(null);

        $this->assertNull($this->directionsRequest->getArrivalTime());
    }

    public function testProvideRouteAlternativesWithValidValue()
    {
        $this->directionsRequest->setProvideRouteAlternatives(true);

        $this->assertTrue($this->directionsRequest->hasProvideRouteAlternatives());
        $this->assertTrue($this->directionsRequest->getProvideRouteAlternatives());
    }

    public function testProvideRouteAlternativesWithNullValue()
    {
        $this->directionsRequest->setProvideRouteAlternatives(true);
        $this->directionsRequest->setProvideRouteAlternatives(null);

        $this->assertNull($this->directionsRequest->getProvideRouteAlternatives());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\DirectionsException
     * @expectedExceptionMessage The directions request provide route alternatives flag must be a boolean value.
     */
    public function testProvideRouteAlternativesWithInvalidValue()
    {
        $this->directionsRequest->setProvideRouteAlternatives('foo');
    }

    public function testRegionWithValidValue()
    {
        $this->directionsRequest->setRegion('fr');

        $this->assertTrue($this->directionsRequest->hasRegion());
        $this->assertSame('fr', $this->directionsRequest->getRegion());
    }

    public function testRegionWithNullValue()
    {
        $this->directionsRequest->setRegion('fr');
        $this->directionsRequest->setRegion(null);

        $this->assertNull($this->directionsRequest->getRegion());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\DirectionsException
     * @expectedExceptionMessage The directions request region must be a string with two characters.
     */
    public function testRegionWithInvalidValue()
    {
        $this->directionsRequest->setRegion('foo');
    }

    public function testLanguageWithValidValue()
    {
        $this->directionsRequest->setLanguage('fr');

        $this->assertTrue($this->directionsRequest->hasLanguage());
        $this->assertSame('fr', $this->directionsRequest->getLanguage());
    }

    public function testLanguageWithNullValue()
    {
        $this->directionsRequest->setLanguage('fr');
        $this->directionsRequest->setLanguage(null);

        $this->assertNull($this->directionsRequest->getLanguage());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\DirectionsException
     * @expectedExceptionMessage The directions request language must be a string with two or five characters.
     */
    public function testLanguageWithInvalidValue()
    {
        $this->directionsRequest->setLanguage('foo');
    }

    public function testTravelModeWithValidValue()
    {
        $this->directionsRequest->setTravelMode(TravelMode::WALKING);

        $this->assertTrue($this->directionsRequest->hasTravelMode());
        $this->assertSame(TravelMode::WALKING, $this->directionsRequest->getTravelMode());
    }

    public function testTravelModeWithNullValue()
    {
        $this->directionsRequest->setTravelMode(TravelMode::WALKING);
        $this->directionsRequest->setTravelMode(null);

        $this->assertNull($this->directionsRequest->getTravelMode());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\DirectionsException
     * @expectedExceptionMessage The directions request travel mode can only be : BICYCLING, DRIVING, WALKING, TRANSIT.
     */
    public function testTravelModeWithInvalidValue()
    {
        $this->directionsRequest->setTravelMode('foo');
    }

    public function testUnitSystemWithValidValue()
    {
        $this->directionsRequest->setUnitSystem(UnitSystem::IMPERIAL);

        $this->assertTrue($this->directionsRequest->hasUnitSystem());
        $this->assertSame(UnitSystem::IMPERIAL, $this->directionsRequest->getUnitSystem());
    }

    public function testUnitSystemWithNullValue()
    {
        $this->directionsRequest->setUnitSystem(UnitSystem::IMPERIAL);
        $this->directionsRequest->setUnitSystem(null);

        $this->assertNull($this->directionsRequest->getUnitSystem());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\DirectionsException
     * @expectedExceptionMessage The directions request unit system can only be : IMPERIAL, METRIC.
     */
    public function testUnitSystemWithInvalidValue()
    {
        $this->directionsRequest->setUnitSystem('foo');
    }

    public function testWaypoint()
    {
        $waypoint = $this->getMock('Ivory\GoogleMap\Services\Directions\DirectionsWaypoint', array(), array(), '', false);
        $this->directionsRequest->setWaypoints(array($waypoint));

        $this->assertTrue($this->directionsRequest->hasWaypoints());
        $this->assertSame(array($waypoint), $this->directionsRequest->getWaypoints());
    }

    public function testSensorWithValidValue()
    {
        $this->directionsRequest->setSensor(true);

        $this->assertTrue($this->directionsRequest->hasSensor());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\DirectionsException
     * @expectedExceptionMessage The directions request sensor flag must be a boolean value.
     */
    public function testSensorWithInvalidValue()
    {
        $this->directionsRequest->setSensor('foo');
    }

    public function testIsValid()
    {
        $this->assertFalse($this->directionsRequest->isValid());
    }

    public function testIsValidWithOrigin()
    {
        $this->directionsRequest->setOrigin('foo');

        $this->assertFalse($this->directionsRequest->isValid());
    }

    public function testIsValidWithDestination()
    {
        $this->directionsRequest->setDestination('foo');

        $this->assertFalse($this->directionsRequest->isValid());
    }

    public function testIsValidWithOriginAndDestination()
    {
        $this->directionsRequest->setDestination('foo');
        $this->directionsRequest->setOrigin('bar');

        $this->assertTrue($this->directionsRequest->isValid());
    }

    public function testIsValidWithValidWaypoint()
    {
        $waypoint = $this->getMock('Ivory\GoogleMap\Services\Directions\DirectionsWaypoint', array(), array(), '', false);
        $waypoint
            ->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(true));

        $this->directionsRequest->setDestination('foo');
        $this->directionsRequest->setOrigin('bar');
        $this->directionsRequest->addWaypoint($waypoint);

        $this->assertTrue($this->directionsRequest->isValid());
    }

    public function testIsValidWithInvalidWaypoint()
    {
        $waypoint = $this->getMock('Ivory\GoogleMap\Services\Directions\DirectionsWaypoint', array(), array(), '', false);
        $waypoint
            ->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(false));

        $this->directionsRequest->setDestination('foo');
        $this->directionsRequest->setOrigin('bar');
        $this->directionsRequest->addWaypoint($waypoint);

        $this->assertFalse($this->directionsRequest->isValid());
    }

    public function testIsValidWithInvalidTransit()
    {
        $this->directionsRequest->setDestination('foo');
        $this->directionsRequest->setOrigin('bar');

        $this->directionsRequest->setTravelMode(TravelMode::TRANSIT);

        $this->assertFalse($this->directionsRequest->isValid());
    }

    public function testIsValidWithValidTransitDepartureTime()
    {
        $this->directionsRequest->setDestination('foo');
        $this->directionsRequest->setOrigin('bar');

        $this->directionsRequest->setTravelMode(TravelMode::TRANSIT);
        $this->directionsRequest->setDepartureTime(new DateTime());

        $this->assertTrue($this->directionsRequest->isValid());
    }

    public function testIsValidWithTransitArrivalTime()
    {
        $this->directionsRequest->setDestination('foo');
        $this->directionsRequest->setOrigin('bar');

        $this->directionsRequest->setTravelMode(TravelMode::TRANSIT);
        $this->directionsRequest->setArrivalTime(new DateTime());

        $this->assertTrue($this->directionsRequest->isValid());
    }

    public function testIsValidWithValidTransitDepartureTimeAndArrivalTime()
    {
        $this->directionsRequest->setDestination('foo');
        $this->directionsRequest->setOrigin('bar');

        $this->directionsRequest->setTravelMode(TravelMode::TRANSIT);
        $this->directionsRequest->setArrivalTime(new DateTime());
        $this->directionsRequest->setDepartureTime(new DateTime());

        $this->assertTrue($this->directionsRequest->isValid());
    }
}
