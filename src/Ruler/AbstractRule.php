<?php

namespace Ruler;

use Ruler\Exceptions\MissingContextException;

/**
 * Class AbstractRuler
 *
 * @package Ruler
 */
abstract class AbstractRule implements IRule
{
    protected $ruleName = null;

    protected $contextRequired = [];

    /**
     * @inheritdoc
     */
    public function getRuleName(): string
    {
        if (empty($this->ruleName)) {
            throw new \RuntimeException("Missing name for rule");
        }

        return $this->ruleName;
    }

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
     * @return int
     *
     * @throws MissingContextException
     */
    final public function evaluate(Context $context): int
    {
        $this->checkContext($context);

        return $this->run($context);
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
            throw new MissingContextException();
        }
    }

    /**
     * @param Context $context
     *
     * @return int
     */
    abstract protected function run(Context $context) : int;
}