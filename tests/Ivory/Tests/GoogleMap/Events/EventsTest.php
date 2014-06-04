<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Events;

use Ivory\GoogleMap\Events\Events;

/**
 * Event manager test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EventManagerTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Events\Events */
    protected $events;

    /** @var \Ivory\GoogleMap\Events\Event */
    protected $eventMock;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->events = new Events();
        $this->eventMock = $this->getMock('Ivory\GoogleMap\Events\Event');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->events);
        unset($this->eventMock);
    }

    public function testDefaultState()
    {
        $this->assertEmpty($this->events->getDomEvents());
        $this->assertEmpty($this->events->getDomEventsOnce());
        $this->assertEmpty($this->events->getEvents());
        $this->assertEmpty($this->events->getEventsOnce());
    }

    public function testInitialState()
    {
        $domEvents = array($this->getMock('Ivory\GoogleMap\Events\Event'));
        $domEventsOnce = array($this->getMock('Ivory\GoogleMap\Events\Event'));
        $events = array($this->getMock('Ivory\GoogleMap\Events\Event'));
        $eventsOnce = array($this->getMock('Ivory\GoogleMap\Events\Event'));

        $this->events = new Events($domEvents, $domEventsOnce, $events, $eventsOnce);

        $this->assertSame($domEvents, $this->events->getDomEvents());
        $this->assertSame($domEventsOnce, $this->events->getDomEventsOnce());
        $this->assertSame($events, $this->events->getEvents());
        $this->assertSame($eventsOnce, $this->events->getEventsOnce());
    }

    public function testDomEvent()
    {
        $this->events->addDomEvent($this->eventMock);

        $this->assertSame(array($this->eventMock), $this->events->getDomEvents());
    }

    public function testDomEventOnce()
    {
        $this->events->addDomEventOnce($this->eventMock);

        $this->assertSame(array($this->eventMock), $this->events->getDomEventsOnce());
    }

    public function testEvent()
    {
        $this->events->addEvent($this->eventMock);

        $this->assertSame(array($this->eventMock), $this->events->getEvents());
    }

    public function testEventOnce()
    {
        $this->events->addEventOnce($this->eventMock);

        $this->assertSame(array($this->eventMock), $this->events->getEventsOnce());
    }
}
