<?php

namespace Ruler\Test\TestingRules;

use PHPUnit\Framework\TestCase;
use Ruler\Context;
use Ruler\Exceptions\DisabledRuleCannotBeEvaluatedException;
use Ruler\IRuleValue;
use Ruler\TestingRules\AddTwoValuesRule;


/**
 * Class RuleEvaluationTest
 *
 * @package Ruler\Test\Rules
 */
class RuleEvaluationTest extends TestCase
{
    public function testEvaluateRuleSuccessful()
    {
        $config = [
            'enabled' => true,
        ];
        $context = new Context(['value1' => 10, 'value2' => 15 ]);
        $rule = new AddTwoValuesRule($config);
        $result = $rule->evaluate($context);

        $this->assertInstanceOf(IRuleValue::class, $result);
        $this->assertEquals('integer', $result->getType());
        $this->assertEquals(25, $result->getValue());
    }

    public function testEvaluateDisabledRuleThrowException()
    {
        $config = [
            'enabled' => false,
        ];
        $context = new Context(['value1' => 10, 'value2' => 15 ]);
        $rule = new AddTwoValuesRule($config);

        $this->expectException(DisabledRuleCannotBeEvaluatedException::class);
        try {
            $result = $rule->evaluate($context);
            $this->fail("This test should throw an exception. But returns a value " . $result->getValue() . ")");
        } catch (DisabledRuleCannotBeEvaluatedException $e) {
            $this->assertEquals(DisabledRuleCannotBeEvaluatedException::CODE, $e->getCode());
            $this->assertEquals('Disabled rule cannot be evaluated', $e->getMessage());
            throw $e;
        } catch (\Exception $e) {
            $this->fail("Unexpected exception");
        }
    }
}