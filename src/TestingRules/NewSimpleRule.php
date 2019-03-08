<?php

namespace Ruler\TestingRules;

use Ruler\AbstractRule;
use Ruler\Context;

/**
 * Class NewSimpleRule
 *
 * @package Ruler\Rules
 */
class NewSimpleRule extends AbstractRule
{
    /**
     * @inheritdoc
     */
    protected function run(Context $context) : int
    {
        return 1;
    }
}
