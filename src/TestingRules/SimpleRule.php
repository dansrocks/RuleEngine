<?php

namespace Ruler\TestingRules;

use Ruler\AbstractRule;
use Ruler\Context;
use Ruler\IRule;

/**
 * Class SimpleRule
 *
 * @package Ruler\Rules
 */
class SimpleRule extends AbstractRule
{
    protected $parameterKeys = [
        'P1',
        'P2',
        'P3',
    ];

    protected $contextRequired = [
        'value' => IRule::CONTEXT_REQUIRED,
    ];

    /**
     * @inheritdoc
     */
    protected function run(Context $context): int
    {
        return $context['value'];
    }
}