<?php

namespace Ruler\TestingRules;

use Ruler\AbstractRule;
use Ruler\Context;
use Ruler\IRule;

/**
 * Class RuleWithExclusionSetup
 *
 * @package Ruler\Rules
 */
class RuleWithExclusionSetup extends AbstractRule
{
    protected $parameterKeys = [];

    protected $contextRequired = [
        'exclude' => IRule::CONTEXT_REQUIRED,
    ];

    /**
     * @inheritdoc
     */
    protected function run(Context $context): int
    {
        return 999;
    }

    /**
     * @param Context $context
     * 
     * @return bool
     */
    public function isExcluded(Context $context): bool
    {
        return $context->offsetExists('exclude')
            ? boolval($context->offsetGet('exclude'))
            : true;
    }
}