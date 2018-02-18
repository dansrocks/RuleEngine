<?php

namespace Ruler\Test\TestingRules;

use PHPUnit\Framework\TestCase;
use Ruler\Context;
use Ruler\Exceptions\MissingContextException;
use Ruler\Exceptions\MissingParametersException;
use Ruler\Exceptions\UndefinedRuleParameterException;
use Ruler\TestingRules\AddTwoValuesRule;
use Ruler\TestingRules\NewSimpleRule;
use Ruler\TestingRules\RuleWithoutRuleSuffix;
use Ruler\TestingRules\SimpleRule;

/**
 * Class RuleBasicTest
 *
 * @package Ruler\Test\Rules
 */
class RuleBasicTest extends TestCase
{

//    public function setUp()
//    {
//        $this->markTestSkipped();
//        parent::setUp();
//    }


    public function testCreateRuleWhitoutAllParamsThrowException()
    {
        $this->expectException(MissingParametersException::class);
        try {
            $params = [];
            $rule = new SimpleRule($params);
        } catch (MissingParametersException $e) {
            $expectedMessage = "Missing parameters (P1, P2, P3)";
            $this->assertEquals($expectedMessage, $e->getMessage());
            throw $e;
        }
    }

    public function testCreateRuleWhitoutSomeParamsThrowException()
    {
        $this->expectException(MissingParametersException::class);
        try {
            $params = [ 'P2' => 20 ];
            $rule = new SimpleRule($params);
        } catch (MissingParametersException $e) {
            $expectedMessage = "Missing parameters (P1, P3)";
            $this->assertEquals($expectedMessage, $e->getMessage());
            throw $e;
        }
    }

    /**
     * Match required context for rule
     */
    public function testGetContextRequiredForRule()
    {
        $params1 = [ 'P1' => 10, 'P2' => 20, 'P3' => 30 ];
        $context1 = [ 'value' ];
        $rule1 = new SimpleRule($params1);
        $this->assertEquals($context1, $rule1->getContextRequired(), "Unexpected context for SimpleRule");

        $context2 = [];
        $rule2 = new NewSimpleRule();
        $this->assertEquals($context2, $rule2->getContextRequired(), "Unexpected context for NewSimpleRule");

        $context3 = [
            'value1',
            'value2',
        ];
        $rule3 = new AddTwoValuesRule();
        $this->assertEquals($context3, $rule3->getContextRequired(), 'Unexpected context for AddTwoValuesRule');

        $context4 = [
        ];
        $rule4 = new RuleWithoutRuleSuffix();
        $this->assertEquals($context4, $rule4->getContextRequired(), 'Unexpected context for RuleWithoutRuleSuffix');
    }

    /**
     * Test evaluate evaluate method
     */
    public function testEvaluateContextRequiredForRuleReturnsValue()
    {
        try {
            $params1 = [ 'P1' => 10, 'P2' => 20, 'P3' => 30 ];
            $context1 = new Context([ 'value' => 15 ]);
            $rule1 = new SimpleRule($params1);
            $this->assertEquals(15, $rule1->evaluate($context1), "Evaluate Simple Rule Failed");

        } catch (MissingContextException $e) {
            $this->fail('Evaluate Simple Rule Failed with bad Missing Context Exception');
        }

        // -------------

        $context2 = new Context([
            'value1' => 15,
            'value2' => 20,
        ]);

        try {
            $rule2 = new AddTwoValuesRule();
            $this->assertEquals(35, $rule2->evaluate($context2), "Evaluate AddTwoValues Rule Failed");

        } catch (MissingContextException $e) {
            $this->fail('Evaluate AddTwoValues Rule Failed with bad Missing Context Exception');
        }

        // -------------
        try {
            $rule3 = new NewSimpleRule();
            $this->assertEquals(1, $rule3->evaluate(new Context()), "Evaluate NewSimpleRule Failed");

        } catch (MissingContextException $e) {
            $this->fail('Evaluate NewSimpleRule Failed with bad Missing Context Exception');
        }

        // -------------

        try {
            $rule4 = new RuleWithoutRuleSuffix();
            $this->assertEquals(25, $rule4->evaluate(new Context()), "Evaluate RuleWithoutRuleSuffix Failed");

        } catch (MissingContextException $e) {
            $this->fail('Evaluate RuleWithoutRuleSuffix Failed with bad Missing Context Exception');
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

    public function _testGetParametersReturnsRightParameters()
    {
        $params1 = [ 'P1' => 10, 'P2' => 20, 'P3' => 30 ];
        $rule = new SimpleRule($params1);

        $expectedParams = [ 'P1', 'P2', 'P3' ];
        $this->assertEquals($expectedParams, $rule->getParametersRequired());
    }

    public function _testGetParameterReturnValues()
    {
        $params = [ 'P1' => 10, 'P2' => 20, 'P3' => 30 ];
        $rule = new SimpleRule($params);

        foreach ($params as $paramKey => $value) {
            $this->assertEquals($value, $rule->getParameter($paramKey));
        }
    }

    public function _testGetParameterWhenParamsDoesntExistThrowException()
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