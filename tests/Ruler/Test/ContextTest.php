<?php

namespace Ruler\Test;

use PHPUnit\Framework\TestCase;
use Ruler\Context;

/**
 * Class ContextTest
 *
 * @package Ruler\Test
 */
class ContextTest extends TestCase
{
    public function testConstruct()
    {
        $data = array(
            'name' => 'Dans Rocks',
            'position' => 'CTO',
        );

        $context = new Context($data);

        $this->assertTrue(isset($context['name']));
        $this->assertEquals('Dans Rocks', $context['name']);

        $this->assertTrue(isset($context['position']));
        $this->assertEquals('CTO', $context['position']);

        $this->assertFalse(isset($context['phone']));
    }

    public function testIsset()
    {
        $context = new Context();

        $context['name'] = 'Dans Rocks';
        $this->assertTrue(isset($context['name']));
        $this->assertEquals('Dans Rocks', $context['name']);

        $context['position'] = 'CTO';
        $this->assertTrue(isset($context['position']));
        $this->assertEquals('CTO', $context['position']);

        $context['position'] = 'CIO';
        $this->assertTrue(isset($context['position']));
        $this->assertEquals('CIO', $context['position'], "Isset: overwrite context failed");

        $address = [
            'address' => 'Gran Vía 18',
            'city' => 'Madrid',
            'country' => 'Spain',
        ];
        $context['address'] = $address;
        $this->assertTrue(isset($context['address']));
        $this->assertEquals($address, $context['address'], "Isset: array assignment failed");

        $object = new \stdClass();
        $object2 = new \stdClass();
        $context['object'] = $object;
        $this->assertTrue(isset($context['object']));
        $this->assertEquals($object, $context['object'], "Isset: object assignment failed");
        $this->assertSame($object, $context['object'], "Isset: object assignment failed");
        $this->assertNotSame($object2, $context['object'], "Isset: object assignment failed");

        $this->assertFalse(isset($context['phone']));
    }

    public function testOffsetGetTest()
    {
        $address = 'Gran Vía 18';
        $city = 'Madrid';
        $country = 'Spain';

        $context = new Context([
            'address' => $address,
            'city' => $city,
            'country' => $country,
        ]);

        $this->assertEquals($address, $context['address']);
        $this->assertEquals($city, $context['city']);
        $this->assertEquals($country, $context['country']);

        $this->expectException(\InvalidArgumentException::class);
        $context['unknown_key'];
    }

    public function testOffsetUnsetTest()
    {
        $context = new Context([
            'address' => 'Gran Vía 18',
            'city' => 'Madrid',
            'country' => 'Spain',
        ]);

        $this->assertTrue(isset($context['address']));
        $this->assertTrue(isset($context['city']));
        $this->assertTrue(isset($context['country']));

        unset($context['address']);

        $this->assertFalse(isset($context['address']));
        $this->assertTrue(isset($context['city']));
        $this->assertTrue(isset($context['country']));

        unset($context['city']);

        $this->assertFalse(isset($context['address']));
        $this->assertFalse(isset($context['city']));
        $this->assertTrue(isset($context['country']));

        unset($context['country']);

        $this->assertFalse(isset($context['address']));
        $this->assertFalse(isset($context['city']));
        $this->assertFalse(isset($context['country']));


        $this->expectException(\InvalidArgumentException::class);
        $context['unknown_key'];
    }
}