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
        $config = [
            'enabled' => true,
            'params' => [
                'P1' => 10,
                'P2' => 20,
                'P3' => 30,
            ],
        ];
        $rule = new SimpleRule($config);

        $expectedParams = [ 'P1', 'P2', 'P3' ];
        $this->assertEquals($expectedParams, $rule->getParametersRequired());
    }

    /**
     * Check that rule has a name
     */
    public function testCreateRuleSuccessful()
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
        $this->assertInstanceOf(SimpleRule::class, $rule);
    }

    /**
     * Check that rule has a name
     */
    public function testCreateEnabledRuleReturnsIsEnabled()
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
        $this->assertTrue($rule->isEnabled());
    }

    /**
     * Check that rule has a name
     */
    public function testCreateDisabledRuleReturnsIsNotEnabled()
    {
        $config = [
            'enabled' => false,
            'params' => [
                'P1' => 10,
                'P2' => 20,
                'P3' => 30,
            ],
        ];

        $rule = new SimpleRule($config);
        $this->assertFalse($rule->isEnabled());
    }

    /**
     * Check that rule has a name
     */
    public function testCreateRuleWithoutParamsThrowException()
    {
        $this->expectException(MissingParametersException::class);

        try {
            $config = [
                'enabled' => true,
                'params' => [
                    'P1' => 10,
                    'P3' => 30,
                ],
            ];
            $rule = new SimpleRule($config);

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
        $config = [
            'enabled' => true,
            'params' => [
                'P1' => 10,
                'P2' => 20,
                'P3' => 30,
            ],
        ];

        $rule = new SimpleRule($config);
        foreach ($config['params'] as $paramKey => $paramValue) {
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
            $config = [
                'enabled' => true,
                'params' => [
                    'P1' => 10,
                    'P2' => 20,
                    'P3' => 30,
                    'P4' => 40,  // <- this param is not required. Will not assigned to Rule
                ]
            ];
            $rule = new SimpleRule($config);
            $rule->getParameter('P4');

        } catch (UndefinedRuleParameterException $e) {
            $expectedMessage = "Undefined Parameter (P4)";
            $this->assertEquals($expectedMessage, $e->getMessage());
            throw $e;
        }
    }
}