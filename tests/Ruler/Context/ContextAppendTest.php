<?php

namespace Ruler\Test\Context;

use PHPUnit\Framework\TestCase;
use Ruler\Context;

/**
 * Class ContextAppendTest
 *
 * @package Ruler\Test\Context
 */
class ContextAppendTest extends TestCase
{

    public function testAppendContextException()
    {
        $data = [
            'name' => 'Dans Rocks',
            'position' => 'CTO',
        ];
        $context = new Context($data);
        $this->assertEquals(array_keys($data), $context->keys());

        $data2 = [
            'phone' => '911 012 340',
            'address' => 'Caleruega 102',
        ];
        $context2 = new Context($data2);

        $context->append($context2);

        $newDataMerged = array_merge($data, $data2);
        $this->assertEquals(array_keys($newDataMerged), $context->keys());

        foreach ($context->keys() as $key) {
            $this->assertEquals($newDataMerged[$key], $context->offsetGet($key));
        }
    }
}