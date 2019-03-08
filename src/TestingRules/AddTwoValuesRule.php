<?php

namespace Ruler\TestingRules;

use Ruler\AbstractRule;
use Ruler\Context;
use Ruler\IRule;

/**
 * Class AddTwoValuesRule
 *
 * @package Ruler\Rules
 */
class AddTwoValuesRule extends AbstractRule
{
    protected $ruleName = "AddTwoValuesRule";

    protected $contextRequired = [
        'value1' => IRule::CONTEXT_REQUIRED,
        'value2' => IRule::CONTEXT_REQUIRED,
    ];

    /**
     * @inheritdoc
     */
    protected function run(Context $context): int
    {
        return $context['value1'] + $context['value2'];
    }
}