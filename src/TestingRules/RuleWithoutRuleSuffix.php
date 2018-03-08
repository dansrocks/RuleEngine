<?php

namespace Ruler\TestingRules;

use Ruler\AbstractRule;
use Ruler\Context;

/**
 * Class RuleWithoutRuleSuffix
 *
 * @package Ruler\Rules
 */
class RuleWithoutRuleSuffix extends AbstractRule
{
    /**
     * @inheritdoc
     */
    protected function run(Context $context) : int
    {
        return 25;
    }
}
