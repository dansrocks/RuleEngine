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

    protected $parameters = [
        'P1' => 'P1.value',
        'P2' => 'P2.value',
        'P3' => 'P3.value',
    ];

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