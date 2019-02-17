<?php

namespace Ruler\Test\TestingRules;

use PHPUnit\Framework\TestCase;
use Ruler\Context;
use Ruler\Exceptions\MissingContextException;
use Ruler\Exceptions\UndefinedRuleParameterException;
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
        $context1 = new Context([
            'value' => 15,
        ]);

        try {
            $rule1 = new SimpleRule();
            $this->assertEquals(15, $rule1->evaluate($context1), "Evaluate Simple Rule Failed");

        } catch (MissingContextException $e) {
            $this->fail('Evaluate Simple Rule Failed with bad Missing Context Exception');
        }

        // -------------

        $context2 = new Context([
            'value1' => 10,
            'value2' => 20,
        ]);

        try {
            $rule2 = new AddTwoValuesRule();
            $this->assertEquals(30, $rule2->evaluate($context2), "Evaluate AddTwoValues Rule Failed");

        } catch (MissingContextException $e) {
            $this->fail('Evaluate AddTwoValues Rule Failed with bad Missing Context Exception');
        }

        // -------------

        $context3 = new Context();

        try {
            $rule3 = new RuleWithEmptyName();
            $this->assertEquals(1, $rule3->evaluate($context3), "Evaluate RuleWithEmptyName Failed");

        } catch (MissingContextException $e) {
            $this->fail('Evaluate RuleWithEmptyName Failed with bad Missing Context Exception');
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

        $this->expectException(MissingContextException::class);
        try {
            $rule = new AddTwoValuesRule();
            $rule->evaluate($context);
        } catch (MissingContextException $e) {
            $expectError = 'Missing context (value2)';
            $this->assertEquals($expectError, $e->getMessage());
            throw  $e;
        }
    }

    public function testGetParametersReturnsRightParameters()
    {
        $rule = new SimpleRule();

        $expectedParams = [ 'P1', 'P2', 'P3' ];
        $this->assertEquals($expectedParams, $rule->getParametersRequired());
    }

    public function testGetParameterReturnValues()
    {
        $rule = new SimpleRule();

        $expectedParams = [
            'P1' => 'P1.value',
            'P2' => 'P2.value',
            'P3' => 'P3.value',
        ];
        foreach ($expectedParams as $paramKey => $value) {
            $this->assertEquals($value, $rule->getParameter($paramKey));
        }
    }

    public function testGetParameterWhenParamsDoesntExistThrowException()
    {
        $this->expectException(UndefinedRuleParameterException::class);

        try {
            $rule = new SimpleRule();
            $rule->getParameter("ParameterP4");

        } catch (UndefinedRuleParameterException $e) {
            $expectedError = "Undefined Parameter (ParameterP4)";
            $this->assertEquals($expectedError, $e->getMessage());
            throw $e;

        } catch (\Exception $e) {
            $this->assertFalse(true, "Unexpected Exception in Rule::getParameter()");
        }
    }
}