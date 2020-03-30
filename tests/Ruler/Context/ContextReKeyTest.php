<?php

namespace Ruler\Test\Context;

use PHPUnit\Framework\TestCase;
use Ruler\Context;

/**
 * Class ContextReKeyTest
 *
 * @package Ruler\Test\Context
 */
class ContextReKeyTest extends TestCase
{

    public function testReKeyContextException()
    {
        $data = [
            'name' => 'Dans Rocks',
            'position' => 'CTO',
            'phone' => '+00 000 0000',
            'address' => 'Unnamed street',
            'city' => 'BigCity',
            'zip' => 'ZB390',
        ];
        $context = new Context($data);
        $this->assertEquals(array_keys($data), $context->keys(), 'Rekey failed - ' . __LINE__);

        $oldKeys = $context->keys();

        $prefix = 'prefix.';
        $context->rekey($prefix);

        $newKeys = [];
        foreach ($oldKeys as $key) {
            $newKey = sprintf("%s%s", $prefix, $key);
            $newKeys[] = $newKey;
            $this->assertFalse($context->offsetExists($key), sprintf("Rekey: old key '%s' still appears", $key));
            $this->assertTrue($context->offsetExists($newKey), sprintf("Rekey: new key '%s' not found", $key));
            $this->assertEquals($data[$key], $context->offsetGet($newKey), 'Rekey: fail to rekey');
        }

        $this->assertEquals($newKeys, $context->keys());
    }
}