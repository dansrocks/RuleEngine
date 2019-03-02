<?php

namespace Ruler\Test\TestingRules;

use PHPUnit\Framework\TestCase;
use Ruler\TestingRules\SimpleRule;

/**
 * Class RuleConfigurationTest
 *
 * @package Ruler\Test\Rules
 */
class RuleConfigurationTest extends TestCase
{
    public function testDefaultSetup()
    {
        $expectedConfig = [
            'enabled' => false,
            'params' => [
                'P1' => null,
                'P2' => null,
                'P3' => null,
            ],
        ];
        try {
            $rule = new SimpleRule();
            $this->assertEquals($expectedConfig, $rule->getRuleSetup());

        } catch (\Exception $e) {
            $this->fail("Unexpected exception: " . $e->getMessage());
        }
    }

    public function testRuleSetupMatchWithAssign()
    {
        $expectedConfig = [
            'enabled' => false,
            'params' => [
                'P1' => null,
                'P2' => null,
                'P3' => null,
            ],
        ];
        $rule = new SimpleRule($expectedConfig);
        $this->assertEquals($expectedConfig, $rule->getRuleSetup());
    }
}