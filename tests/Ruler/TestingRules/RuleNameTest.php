<?php

namespace Ruler\Test\TestingRules;

use PHPUnit\Framework\TestCase;
use Ruler\TestingRules\RuleWithoutRuleSuffix;
use Ruler\TestingRules\SimpleRule;

/**
 * Class RuleNameTest
 *
 * @package Ruler\Test\Rules
 */
class RuleNameTest extends TestCase
{
    /**
     * Check that rule has a name
     */
    public function testRuleName()
    {
        $config = [
            'enabled' => true,
            'params' => [
                'P1' => 10,
                'P2' => 20,
                'P3' => 30,
            ],
        ];

        $rule = new SimpleRule($config);
        $this->assertEquals('Simple', $rule->getRuleName());
    }

    /**
     * Check that rule has a name
     */
    public function testRuleNameInRuleWithoutRuleSuffix()
    {
        $config = [
            'enabled' => false,
        ];

        $rule = new RuleWithoutRuleSuffix($config);
        $this->assertEquals('RuleWithoutRuleSuffix', $rule->getRuleName());
    }
}