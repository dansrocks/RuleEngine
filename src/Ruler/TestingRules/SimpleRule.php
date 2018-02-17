<?php

namespace Ruler\TestingRules;

use Ruler\AbstractRule;
use Ruler\Context;

/**
 * Class SimpleRule
 *
 * @package Ruler\Rules
 */
class SimpleRule extends AbstractRule
{
    protected $ruleName = "SimpleRule";

    protected $contextRequired = [
        'value',
    ];

    /**
     * @inheritdoc
     */
    protected function run(Context $context): int
    {
        return $context['value'];
    }
}