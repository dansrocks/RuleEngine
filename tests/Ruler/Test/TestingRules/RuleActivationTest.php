<?php

namespace Ruler\Test\TestingRules;

use PHPUnit\Framework\TestCase;
use Ruler\TestingRules\SimpleRule;

/**
 * Class RuleActivationTest
 *
 * @package Ruler\Test\Rules
 */
class RuleActivationTest extends TestCase
{

    public function testDefaultRuleIsDisabled()
    {
        $rule = new SimpleRule();
        $this->assertFalse($rule->isEnabled());
    }

    public function testActivateRuleReturnsIsEnabled()
    {
        $rule = new SimpleRule();
        $rule->enable();
        $this->assertTrue($rule->isEnabled());

        $rule->disable();
        $this->assertFalse($rule->isEnabled());

        $rule->enable();
        $this->assertTrue($rule->isEnabled());
    }

    public function testSetupRuleAsDisabledReturnsIsNotEnabled()
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
        $this->assertFalse($rule->isEnabled());
    }

    public function testSetupRuleAsEnabledReturnsIsEnabled()
    {
        $expectedConfig = [
            'enabled' => true,
            'params' => [
                'P1' => null,
                'P2' => null,
                'P3' => null,
            ],
        ];
        $rule = new SimpleRule($expectedConfig);
        $this->assertTrue($rule->isEnabled());
    }
}