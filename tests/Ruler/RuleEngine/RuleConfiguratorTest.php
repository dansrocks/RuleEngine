<?php

namespace Ruler\Test\RuleEngine;

use \PHPUnit\Framework\TestCase;
use Ruler\Context;
use Ruler\IRuleConfigurator;
use Ruler\RuleConfigurator;
use Ruler\RuleEngine;
use Ruler\TestingRules\AddTwoValuesRule;

class RuleConfiguratorTest  extends TestCase
{
    public function testConfigurator()
    {
        $ruleClassName = AddTwoValuesRule::class;
        $config = [
            $ruleClassName => [
                'enable' => true,
                'params' => [ 'dummyconfig' => 'ignorar' ],
            ],
        ];

        $configurator = new RuleConfigurator($config);
        $this->assertInstanceOf(IRuleConfigurator::class, $configurator);

        $this->assertNotEmpty($configurator->getConfig($ruleClassName));

        $this->assertEmpty($configurator->getConfig('clase inexistente'));
    }
}