<?php

namespace Ruler\Traits;

use Ruler\Context;
use Ruler\Exceptions\MissingContextException;

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
    public function getContextRequired(): array
    {
        return $this->contextRequired;
    }

    /**
     * @param Context $context
     *
     * @throws MissingContextException
     */
    protected function checkContext(Context $context): void
    {
        $missingContextKeys = array_diff_key($this->getContextRequired(), $context->keys());
        if (! empty($missingContextKeys)) {
            throw new MissingContextException(implode(',', $missingContextKeys));
        }
    }
}