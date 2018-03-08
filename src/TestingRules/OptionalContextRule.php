<?php

namespace Ruler\TestingRules;

use Ruler\AbstractRule;
use Ruler\Context;
use Ruler\IRule;

/**
 * Class OptionalContextRule
 *
 * @package Ruler\Rules
 */
class OptionalContextRule extends AbstractRule
{
    protected $parameterKeys = [];

    protected $contextRequired = [
        'optional_value_1' => IRule::CONTEXT_OPTIONAL,
        'optional_value_2' => IRule::CONTEXT_OPTIONAL,
        'required_value_1' => IRule::CONTEXT_REQUIRED,
        'required_value_2' => IRule::CONTEXT_REQUIRED,
    ];

    /**
     * @inheritdoc
     */
    protected function run(Context $context): int
    {
        $value =  $context['required_value_1'] + $context['required_value_2'];

        if ($context->offsetExists('optional_value_1')) {
            $value += $context['optional_value_1'];
        }

        if ($context->offsetExists('optional_value_2')) {
            $value += $context['optional_value_2'];
        }

        return $value;
    }
}