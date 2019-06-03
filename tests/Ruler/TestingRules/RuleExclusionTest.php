<?php

namespace Ruler\Test\TestingRules;

use PHPUnit\Framework\TestCase;
use Ruler\Context;
use Ruler\Exceptions\InvalidRuleConfigurationException;
use Ruler\Exceptions\MissingParametersException;
use Ruler\IRule;
use Ruler\TestingRules\NewSimpleRule;
use Ruler\TestingRules\RuleWithExclusionSetup;

/**
 * Class RuleExclusionTest
 *
 * @package Ruler\Test\Rules
 */
class RuleExclusionTest extends TestCase
{
    /**
     * @covers \Ruler\AbstractRule::isExcluded
     */
    public function testDefaultRuleReturnNotExcluded()
    {
        try {
            $config = [
                'enabled' => true,
            ];
            $rule = new NewSimpleRule($config);

            $emptyContext = new Context([]);
            $exclude = $rule->isExcluded($emptyContext);
            $this->assertFalse($exclude);

        } catch (InvalidRuleConfigurationException $e) {
            $this->addWarning(sprintf("Excepción inexperada en %s (L.%d)", __METHOD__, __LINE__));
            $this->assertTrue(false);
        } catch (MissingParametersException $e) {
            $this->addWarning(sprintf("Excepción inexperada en %s (L.%d)", __METHOD__, __LINE__));
            $this->assertTrue(false);
        }
    }

    /**
     * @ignore
     *
     * @dataProvider ruleProvider
     *
     * @param IRule $rule
     */
    public function testRuleNotExcludedReturnNotExcluded(IRule $rule)
    {
        try {
            $context = new Context([ 'exclude' => false ]);
            $this->assertFalse($rule->isExcluded($context));

        } catch (\Exception $e) {
            $this->addWarning("Excepción inexperada en " . __METHOD__);
            $this->assertTrue(false);
        }
    }

    /**
     * @dataProvider ruleProvider
     *
     * @param IRule $rule
     */
    public function testRuleExcludedReturnExcluded(IRule $rule)
    {
        try {
            $context = new Context([ 'exclude' => true ]);
            $this->assertTrue($rule->isExcluded($context));

        } catch (\Exception $e) {
            $this->addWarning("Excepción inexperada en " . __METHOD__);
            $this->assertTrue(false);
        }
    }

    /**
     * @return array
     *
     * @throws InvalidRuleConfigurationException
     * @throws MissingParametersException
     */
    public function ruleProvider(): array
    {
        $config = [
            'enabled' => true,
            'params' => [],
        ];
        $rule = new RuleWithExclusionSetup($config);

        return [
            [$rule],
        ];
    }
}