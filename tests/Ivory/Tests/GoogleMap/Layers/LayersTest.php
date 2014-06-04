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

use Ivory\GoogleMap\Layers\Layers;

/**
 * Layers test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class LayersTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Layers\Layers */
    protected $layers;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->layers = new Layers();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->layers);
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->layers->hasKMLLayers());
    }

    public function testKmlLayer()
    {
        $kmlLayer = $this->getMock('Ivory\GoogleMap\Layers\KMLLayer');
        $this->layers->addKMLLayer($kmlLayer);

        $this->assertSame(array($kmlLayer), $this->layers->getKMLLayers());
    }
}
