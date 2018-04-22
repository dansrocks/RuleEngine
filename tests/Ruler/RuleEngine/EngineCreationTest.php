<?php

namespace Ruler\Test\RuleEngine;

use \PHPUnit\Framework\TestCase;
use Ruler\Context;
use Ruler\RuleConfigurator;
use Ruler\RuleEngine;
use Ruler\RuleResult;
use Ruler\RuleValue;
use Ruler\TestingRules\AddTwoValuesRule;
use Ruler\TestingRules\NewSimpleRule;

class EngineCreationTest extends TestCase
{
    public function testConfiguraDummy()
    {
        $ruleClassName = AddTwoValuesRule::class;
        $config = [
            $ruleClassName => [
                'enabled' => true,
                'params' => []
            ],
        ];

        $context = new Context([
            'value1'=> 2,
            'value2'=> 3,
        ]);

        $configurator = new RuleConfigurator($config);
        $engine = new RuleEngine($configurator, array_keys($config));
        $engine->execute($context);

        $results = $engine->getResults();

        $this->assertIsArray($results);
        $this->assertArrayHasKey('AddTwoValues', $results);
        $this->assertArrayNotHasKey(NewSimpleRule::class, $results);

        $expectedResults = [
            'AddTwoValues' => new RuleResult(
                'AddTwoValues',
                true,
                new RuleValue(5)
            )
        ];

        $this->assertEquals($expectedResults, $results);
    }
}