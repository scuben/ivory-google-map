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

use Ivory\GoogleMap\Services\Directions\Directions;
use Ivory\GoogleMap\Services\Directions\DirectionsRequest;
use Ivory\GoogleMap\Services\Directions\DirectionsStatus;
use Ivory\GoogleMap\Services\Directions\DirectionsWaypoint;
use Ivory\GoogleMap\Services\Base\TravelMode;
use Ivory\GoogleMap\Services\Base\UnitSystem;
use Widop\HttpAdapter\CurlHttpAdapter;

/**
 * Directions test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class DirectionsTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Services\Directions\Directions */
    protected $directions;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        sleep(5);

        $this->directions = new Directions(new CurlHttpAdapter());
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->directions);
    }

    public function testRouteWithDirectionsRequest()
    {
        $request = new DirectionsRequest('50.629381, 3.057268', '48.856633, 2.352254');
        $request->setTravelMode(TravelMode::DRIVING);
        $request->setProvideRouteAlternatives(true);
        $request->setUnitSystem(UnitSystem::METRIC);
        $request->setRegion('fr');

        $response = $this->directions->route($request);

        $this->assertSame(DirectionsStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithDirectionsRequestAndStringWaypointAndOptimizeWaypoint()
    {
        $request = new DirectionsRequest('Lille', 'Paris');
        $request->addWaypoint(new DirectionsWaypoint('Compiègne'));

        $request->setOptimizeWaypoints(true);

        $response = $this->directions->route($request);

        $this->assertSame(DirectionsStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithDirectionsRequestAndCoordinateWaypoint()
    {
        $request = new DirectionsRequest('Lille', 'Paris');
        $request->addWaypoint(new DirectionsWaypoint('49.418079, 2.826190'));

        $request->setOptimizeWaypoints(true);

        $response = $this->directions->route($request);

        $this->assertSame(DirectionsStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithDirectionsRequestAndStopoverWaypoint()
    {
        $waypoint = new DirectionsWaypoint();
        $waypoint->setLocation('Compiègne');
        $waypoint->setStopover(true);

        $request = new DirectionsRequest();
        $request->setOrigin('Lille');
        $request->addWaypoint($waypoint);
        $request->setDestination('Paris');

        $response = $this->directions->route($request);

        $this->assertSame(DirectionsStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithDirectionsRequestAndAvoidTolls()
    {
        $request = new DirectionsRequest('Lille', 'Paris');
        $request->setAvoidTolls(true);

        $response = $this->directions->route($request);

        $this->assertSame(DirectionsStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithDirectionsRequestAndAvoidHighways()
    {
        $request = new DirectionsRequest('Lille', 'Paris');
        $request->setAvoidHighways(true);

        $response = $this->directions->route($request);

        $this->assertSame(DirectionsStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithDirectionsRequestAndLanguage()
    {
        $request = new DirectionsRequest('Lille', 'Paris');
        $request->setLanguage('fr');

        $response = $this->directions->route($request);

        $this->assertSame(DirectionsStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithDirectionsRequestAndTransitModeAndDepartureTime()
    {
        $request = new DirectionsRequest('601-625 Ashbury Street, San Francisco', 'Bike Route 95, San Francisco');

        $request->setTravelMode(TravelMode::TRANSIT);
        $request->setDepartureTime(new \DateTime());

        $response = $this->directions->route($request);

        $this->assertSame(DirectionsStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithDirectionsRequestAndTransitModeAndArrivalTime()
    {
        $request = new DirectionsRequest('601-625 Ashbury Street, San Francisco', 'Bike Route 95, San Francisco');

        $request->setTravelMode(TravelMode::TRANSIT);
        $request->setArrivalTime(new \DateTime('+2 hours'));

        $response = $this->directions->route($request);

        $this->assertSame(DirectionsStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithDirectionsRequestAndTransitModeAndDepartureTimeAndArrivalTime()
    {
        $request = new DirectionsRequest('601-625 Ashbury Street, San Francisco', 'Bike Route 95, San Francisco');

        $request->setTravelMode(TravelMode::TRANSIT);
        $request->setArrivalTime(new \DateTime());
        $request->setArrivalTime(new \DateTime('+2 hours'));

        $response = $this->directions->route($request);

        $this->assertSame(DirectionsStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testRouteWithXmlFormat()
    {
        $this->directions->setFormat('xml');
        $response = $this->directions->route(new DirectionsRequest('Lille', 'Paris'));

        $this->assertSame(DirectionsStatus::OK, $response->getStatus());
        $this->assertNotEmpty($response->getRoutes());
    }

    public function testSignUrlWithoutBusinessAccount()
    {
        $method = new \ReflectionMethod($this->directions, 'signUrl');
        $method->setAccessible(true);

        $url = 'http://maps.googleapis.com/maps/api/staticmap?center=%E4%B8%8A%E6%B5%B7+%E4%B8%AD%E5%9C%8B&size=640x640&zoom=10&sensor=false';

        $this->assertSame($url, $method->invoke($this->directions, $url));
    }

    public function testSignUrlWithBusinessAccount()
    {
        $url = 'http://maps.googleapis.com/maps/api/staticmap?center=%E4%B8%8A%E6%B5%B7+%E4%B8%AD%E5%9C%8B&size=640x640&zoom=10&sensor=false';

        $businessAccount = $this->getMockBuilder('Ivory\GoogleMap\Services\BusinessAccount')
            ->disableOriginalConstructor()
            ->getMock();

        $businessAccount
            ->expects($this->once())
            ->method('signUrl')
            ->with($this->equalTo($url))
            ->will($this->returnValue('url'));

        $this->directions->setBusinessAccount($businessAccount);

        $method = new \ReflectionMethod($this->directions, 'signUrl');
        $method->setAccessible(true);

        $this->assertSame('url', $method->invoke($this->directions, $url));
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\DirectionsException
     * @expectedExceptionMessage The directions request is not valid. It needs at least an origin and a destination.
     * If you add waypoint to the directions request, it needs at least a location.
     */
    public function testRouteWithInvalidRequest()
    {
        $this->directions->route(new DirectionsRequest('', ''));
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\DirectionsException
     * @expectedExceptionMessage The service result is not valid.
     */
    public function testRouteWithInvalidResult()
    {
        $httpAdapterMock = $this->getMock('Widop\HttpAdapter\HttpAdapterInterface');
        $httpAdapterMock
            ->expects($this->once())
            ->method('getContent')
            ->will($this->returnValue(null));

        $this->directions = new Directions($httpAdapterMock);
        $this->directions->route(new DirectionsRequest('Lille', 'Paris'));
    }
}
