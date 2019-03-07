<?php

namespace Ruler\Traits;

use Ruler\Context;
use Ruler\Exceptions\MissingContextException;
use Ruler\IRule;

/**
 * Trait RuleContextTrait
 *
 * @package Ruler\Traits
 */
trait RuleContextTrait
{
    protected $contextRequired = [];


    /**
     * @inheritdoc
     */
    public function getContextRequired($includeOptional = true): array
    {
        $context = (true === $includeOptional)
            ? $this->contextRequired
            : array_filter($this->contextRequired, function ($type) { return $type === IRule::CONTEXT_REQUIRED; });

        return array_keys($context);
    }

    /**
     * @param Context $context
     *
     * @throws MissingContextException
     */
    protected function checkContext(Context $context): void
    {
        $missingContextKeys = array_diff_key($this->getContextRequired(false), $context->keys());
        if (! empty($missingContextKeys)) {
            throw new MissingContextException(implode(',', $missingContextKeys));
        }
    }
}