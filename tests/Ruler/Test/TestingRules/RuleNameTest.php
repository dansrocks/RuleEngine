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
        $params = [
            'P1' => 10,
            'P2' => 20,
            'P3' => 30,
        ];

        $rule = new SimpleRule($params);
        $this->assertEquals('Simple', $rule->getRuleName());
    }

    /**
     * Check that rule has a name
     */
    public function testRuleNameInRuleWithoutRuleSuffix()
    {
        $rule = new RuleWithoutRuleSuffix();
        $this->assertEquals('RuleWithoutRuleSuffix', $rule->getRuleName());
    }
}