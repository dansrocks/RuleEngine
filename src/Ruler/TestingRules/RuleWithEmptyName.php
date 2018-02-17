<?php

namespace Ruler\TestingRules;

use Ruler\AbstractRule;
use Ruler\Context;

/**
 * Class RuleWithEmptyName
 *
 * @package Ruler\Rules
 */
class RuleWithEmptyName extends AbstractRule
{
    /**
     * @inheritdoc
     */
    protected function run(Context $context) : int
    {
        return 1;
    }
}
