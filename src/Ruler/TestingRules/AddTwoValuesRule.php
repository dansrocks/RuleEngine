<?php

namespace Ruler\TestingRules;

use Ruler\AbstractRule;
use Ruler\Context;

/**
 * Class AddTwoValuesRule
 *
 * @package Ruler\Rules
 */
class AddTwoValuesRule extends AbstractRule
{
    protected $ruleName = "AddTwoValuesRule";

    protected $contextRequired = [
        'value1',
        'value2',
    ];

    /**
     * @inheritdoc
     */
    protected function run(Context $context): int
    {
        return $context['value1'] + $context['value2'];
    }
}