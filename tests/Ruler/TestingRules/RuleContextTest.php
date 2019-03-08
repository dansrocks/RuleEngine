<?php

namespace Ruler\Test\TestingRules;

use PHPUnit\Framework\TestCase;
use Ruler\TestingRules\OptionalContextRule;
use Ruler\TestingRules\RuleWithoutRuleSuffix;
use Ruler\TestingRules\SimpleRule;

/**
 * Class RuleContextTest
 *
 * @package Ruler\Test\Rules
 */
class RuleContextTest extends TestCase
{
    /**
     * Check that rule has a name
     */
    public function testContextRequiredIncludeOptionalContext()
    {
        $config = [
            'enabled' => true,
        ];

        $rule = new OptionalContextRule($config);
        $expected_context = [
            'optional_value_1',
            'optional_value_2',
            'required_value_1',
            'required_value_2',
        ];

        $this->assertEquals($expected_context, $rule->getContextRequired());
    }

    /**
     * Check that rule has a name
     */
    public function testContextRequiredFilterOptionalContext()
    {
        $config = [
            'enabled' => true,
        ];

        $rule = new OptionalContextRule($config);
        $expected_context = [
            'required_value_1',
            'required_value_2',
        ];

        $this->assertEquals($expected_context, $rule->getContextRequired(false));
    }
}