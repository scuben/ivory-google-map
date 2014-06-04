<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Places;

use Ivory\GoogleMap\Places\Autocomplete;
use Ivory\GoogleMap\Places\AutocompleteComponentRestriction;
use Ivory\GoogleMap\Places\AutocompleteType;

/**
 * Autocomplete test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AutocompleteTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Ivory\GoogleMap\Places\Autocomplete */
    protected $autocomplete;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->autocomplete = new Autocomplete();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->autocomplete);
    }

    public function testDefaultState()
    {
        $this->assertSame('place_input', $this->autocomplete->getInputId());
        $this->assertFalse($this->autocomplete->hasBound());
        $this->assertFalse($this->autocomplete->hasTypes());
        $this->assertFalse($this->autocomplete->hasComponentRestrictions());
        $this->assertFalse($this->autocomplete->hasValue());
        $this->assertSame(array('type' => 'text', 'placeholder' => 'off'), $this->autocomplete->getInputAttributes());
        $this->assertFalse($this->autocomplete->isAsync());
        $this->assertSame('en', $this->autocomplete->getLanguage());
    }

    public function testInputIdWithValidValue()
    {
        $this->autocomplete->setInputId('input');

        $this->assertSame('input', $this->autocomplete->getInputId());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\PlaceException
     * @expectedExceptionMessage The place autocomplete input ID must be a string value.
     */
    public function testInputIdWithInvalidValue()
    {
        $this->autocomplete->setInputId(true);
    }

    public function testBoundWithBound()
    {
        $bound = $this->getMock('Ivory\GoogleMap\Base\Bound');
        $this->autocomplete->setBound($bound);

        $this->assertSame($bound, $this->autocomplete->getBound());
    }

    public function testBoundWithNullValue()
    {
        $this->autocomplete->setBound($this->getMock('Ivory\GoogleMap\Base\Bound'));
        $this->autocomplete->setBound(null);

        $this->assertNull($this->autocomplete->getBound());
    }

    public function testTypesWithValidTypes()
    {
        $types = array(AutocompleteType::ESTABLISHMENT, AutocompleteType::GEOCODE);
        $this->autocomplete->setTypes($types);

        $this->assertSame($types, $this->autocomplete->getTypes());

        $this->assertTrue($this->autocomplete->hasTypes());
        $this->assertTrue($this->autocomplete->hasType(AutocompleteType::ESTABLISHMENT));
    }

    /**
     * @expectedException Ivory\GoogleMap\Exception\PlaceException
     * @expectedExceptionMessage The place autocomplete type can only be: establishment, geocode, (regions), (cities).
     */
    public function testAddTypeWithInvalidType()
    {
        $this->autocomplete->addType('foo');
    }

    /**
     * @expectedException Ivory\GoogleMap\Exception\PlaceException
     * @expectedExceptionMessage The place autocomplete type "establishment" already exists.
     */
    public function testAddTypeWithExistingType()
    {
        $this->autocomplete->addType(AutocompleteType::ESTABLISHMENT);
        $this->autocomplete->addType(AutocompleteType::ESTABLISHMENT);
    }

    public function testRemoveTypeWithValidType()
    {
        $this->autocomplete->addType(AutocompleteType::ESTABLISHMENT);
        $this->autocomplete->removeType(AutocompleteType::ESTABLISHMENT);

        $this->assertFalse($this->autocomplete->hasType(AutocompleteType::ESTABLISHMENT));
    }

    /**
     * @expectedException Ivory\GoogleMap\Exception\PlaceException
     * @expectedExceptionMessage The place autocomplete type "establishment" does not exist.
     */
    public function testRemoveTypeWithNonExistingType()
    {
        $this->autocomplete->removeType(AutocompleteType::ESTABLISHMENT);
    }

    public function testComponentRestrictionsWithValidComponentRestrictions()
    {
        $componentRestrictions = array(AutocompleteComponentRestriction::COUNTRY => 'fr');
        $this->autocomplete->setComponentRestrictions($componentRestrictions);

        $this->assertSame($componentRestrictions, $this->autocomplete->getComponentRestrictions());

        $this->assertTrue($this->autocomplete->hasComponentRestrictions());
        $this->assertSame($componentRestrictions, $this->autocomplete->getComponentRestrictions());

        $this->assertTrue($this->autocomplete->hasComponentRestriction(AutocompleteComponentRestriction::COUNTRY));
        $this->assertSame(
            $componentRestrictions[AutocompleteComponentRestriction::COUNTRY],
            $this->autocomplete->getComponentRestriction(AutocompleteComponentRestriction::COUNTRY)
        );
    }

    /**
     * @expectedException Ivory\GoogleMap\Exception\PlaceException
     * @expectedExceptionMessage The place autocomplete component restriction type "country" does not exist.
     */
    public function testComponentRestrictionsWithInvalidComponentRestrictions()
    {
        $this->autocomplete->getComponentRestriction(AutocompleteComponentRestriction::COUNTRY);
    }

    /**
     * @expectedException Ivory\GoogleMap\Exception\PlaceException
     * @expectedExceptionMessage The place autocomplete component restriction can only be: country.
     */
    public function testAddComponentRestrictionWithInvalidComponentRestrictions()
    {
        $this->autocomplete->addComponentRestriction('foo', 'bar');
    }

    /**
     * @expectedException Ivory\GoogleMap\Exception\PlaceException
     * @expectedExceptionMessage The place autocomplete component restriction type "country" already exists.
     */
    public function testAddComponentRestrictionWithExistingComponentRestriction()
    {
        $this->autocomplete->addComponentRestriction(AutocompleteComponentRestriction::COUNTRY, 'foo');
        $this->autocomplete->addComponentRestriction(AutocompleteComponentRestriction::COUNTRY, 'bar');
    }

    public function testRemoveComponentRestrictionWithValidComponentRestriction()
    {
        $this->autocomplete->addComponentRestriction(AutocompleteComponentRestriction::COUNTRY, 'foo');
        $this->autocomplete->removeComponentRestriction(AutocompleteComponentRestriction::COUNTRY);

        $this->assertFalse($this->autocomplete->hasComponentRestriction(AutocompleteComponentRestriction::COUNTRY));
    }

    /**
     * @expectedException Ivory\GoogleMap\Exception\PlaceException
     * @expectedExceptionMessage The place autocomplete component restriction type "country" does not exist.
     */
    public function testRemoveComponentRestrictionWithNonExistingComponentRestriction()
    {
        $this->autocomplete->removeComponentRestriction(AutocompleteComponentRestriction::COUNTRY);
    }

    public function testValue()
    {
        $this->autocomplete->setValue('foo');

        $this->assertSame('foo', $this->autocomplete->getValue());
    }

    public function testInputAttributesWithValidValue()
    {
        $this->autocomplete->setInputAttributes(array('foo' => 'bar'));

        $inputAttributes = $this->autocomplete->getInputAttributes();

        $this->assertArrayHasKey('foo', $inputAttributes);
        $this->assertSame('bar', $inputAttributes['foo']);
    }

    public function testInputAttributesWithNullValue()
    {
        $this->autocomplete->setInputAttribute('foo', 'bar');
        $this->autocomplete->setInputAttribute('foo', null);

        $this->assertArrayNotHasKey('foo', $this->autocomplete->getInputAttributes());
    }

    public function testAsyncWithValidValue()
    {
        $this->autocomplete->setAsync(true);

        $this->assertTrue($this->autocomplete->isAsync());
    }

    /**
     * @expectedException \Ivory\GoogleMap\Exception\PlaceException
     * @expectedExceptionMessage The asynchronous load of a place autocomplete must be a boolean value.
     */
    public function testAsyncWithInvalidValue()
    {
        $this->autocomplete->setAsync('foo');
    }

    public function testLanguage()
    {
        $this->autocomplete->setLanguage('fr');

        $this->assertSame('fr', $this->autocomplete->getLanguage());
    }
}
