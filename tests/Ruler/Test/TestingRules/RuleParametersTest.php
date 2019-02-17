<?php

namespace Ruler\Test\TestingRules;

use PHPUnit\Framework\TestCase;
use Ruler\Exceptions\MissingParametersException;
use Ruler\Exceptions\UndefinedRuleParameterException;
use Ruler\TestingRules\SimpleRule;

/**
 * Class RuleParametersTest
 *
 * @package Ruler\Test\Rules
 */
class RuleParametersTest extends TestCase
{

    public function testRequiredParametersMethod()
    {
        $params = [
            'P1' => 10,
            'P2' => 20,
            'P3' => 30,
        ];
        $rule = new SimpleRule($params);

        $expectedParams = [ 'P1', 'P2', 'P3' ];
        $this->assertEquals($expectedParams, $rule->getParametersRequired());
    }

    /**
     * Check that rule has a name
     */
    public function testCreateRuleSuccessful()
    {
        $params = [
            'P1' => 10,
            'P2' => 20,
            'P3' => 30,
        ];

        $rule = new SimpleRule($params);
        $this->assertInstanceOf(SimpleRule::class, $rule);
    }

    /**
     * Check that rule has a name
     */
    public function testCreateRuleWithoutParamsThrowException()
    {
        $this->expectException(MissingParametersException::class);

        try {
            $params = [
                'P1' => 10,
                'P3' => 30,
            ];
            $rule = new SimpleRule($params);

        } catch (MissingParametersException $e) {
            $expectedMessage = "Missing parameters (P2)";
            $this->assertEquals($expectedMessage, $e->getMessage());
            throw $e;
        }
    }

    /**
     * Test description missing
     */
    public function testCheckParamsValues()
    {
        $params = [
            'P1' => 10,
            'P2' => 20,
            'P3' => 30,
        ];

        $rule = new SimpleRule($params);
        foreach ($params as $paramKey => $paramValue) {
            $this->assertEquals($paramValue, $rule->getParameter($paramKey));
        }
    }

    /**
     * Test description missing
     */
    public function testGetUnknownParamThrowException()
    {
        $this->expectException(UndefinedRuleParameterException::class);

        try {
            $params = [
                'P1' => 10,
                'P2' => 20,
                'P3' => 30,
                'P4' => 40,  // <- this param is not required. Will not assigned to Rule
            ];
            $rule = new SimpleRule($params);
            $rule->getParameter('P4');

        } catch (UndefinedRuleParameterException $e) {
            $expectedMessage = "Undefined Parameter (P4)";
            $this->assertEquals($expectedMessage, $e->getMessage());
            throw $e;
        }
    }
}