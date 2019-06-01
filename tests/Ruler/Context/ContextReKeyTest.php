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
        ];
        $context = new Context($data);
        $this->assertEquals(array_keys($data), $context->keys());

        $oldKeys = $context->keys();

        $prefix = 'prefix.';
        $context->rekey($prefix);

        $newKeys = [];
        foreach ($oldKeys as $key) {
            $newKey = sprintf("%s%s", $prefix, $key);
            $newKeys[] = $newKey;
            $this->assertFalse($context->offsetExists($key));
            $this->assertTrue($context->offsetExists($newKey));
            $this->assertEquals($data[$key], $context->offsetGet($newKey));
        }

        $this->assertEquals($newKeys, $context->keys());
    }
}