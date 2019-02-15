<?php

namespace Ruler\Test\TestingRules;

use PHPUnit\Framework\TestCase;
use Ruler\Context;
use Ruler\Exceptions\MissingContextException;
use Ruler\TestingRules\AddTwoValuesRule;
use Ruler\TestingRules\RuleWithEmptyName;
use Ruler\TestingRules\SimpleRule;

/**
 * Class RuleBasicTest
 *
 * @package Ruler\Test\Rules
 */
class RuleBasicTest extends TestCase
{
    /**
     * Check that rule has a name
     */
    public function testRuleName()
    {
        $rule = new SimpleRule();
        $this->assertEquals('SimpleRule', $rule->getRuleName());
    }

    /**
     * Check that rule returns an Exception when its name is empty
     */
    public function testRuleWithoutName()
    {
        $this->expectException(\RuntimeException::class);

        $rule = new RuleWithEmptyName();
        $rule->getRuleName();
    }

    /**
     * Match required context for rule
     */
    public function testGetContextRequiredForRule()
    {
        $context1 = [
            'value',
        ];
        $rule1 = new SimpleRule();
        $this->assertEquals($context1, $rule1->getContextRequired(), "Missing context for SimpleRule");


        $context2 = [
            'value1',
            'value2',
        ];
        $rule2 = new AddTwoValuesRule();
        $this->assertEquals($context2, $rule2->getContextRequired(), 'Missing context for AddTwoValuesRule');
    }

    /**
     * Test evaluate evaluate method
     */
    public function testEvaluateContextRequiredForRuleReturnsValue()
    {
        $context = new Context([
            'value1' => 10,
            'value2' => 20,
        ]);

        try {
            $rule = new AddTwoValuesRule();
            $this->assertEquals(30, $rule->evaluate($context), "Evaluate Simple Rule Failed");

        } catch (MissingContextException $e) {
            $this->fail('Evaluate Simple Rule Failed with bad Missing Context Exception');
        }
    }

    /**
     * Test that evaluate throws an exception when rule doesn't has a full contest
     */
    public function testEvaluateContextRequiredForRuleThrowsException()
    {
        $context = new Context([
            'value1' => 10,
        ]);

        $rule = new AddTwoValuesRule();
        $this->expectException(MissingContextException::class);
        $rule->evaluate($context);
    }
}