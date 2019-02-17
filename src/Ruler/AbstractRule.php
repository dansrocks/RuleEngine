<?php

namespace Ruler;

use Ruler\Exceptions\MissingContextException;
use Ruler\Exceptions\UndefinedRuleParameterException;

/**
 * Class AbstractRule
 *
 * @package Ruler
 */
abstract class AbstractRule implements IRule
{
    protected $ruleName = null;

    protected $parameters = [];

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
    public function getParametersRequired(): array
    {
        return array_keys($this->parameters);
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
            throw new MissingContextException(implode(',', $missingContextKeys));
        }
    }

    /**
     * @param string $paramKey
     *
     * @return mixed
     *
     * @throws UndefinedRuleParameterException
     */
    public function getParameter(string $paramKey)
    {
        if (! array_key_exists($paramKey, $this->parameters)) {
            throw new UndefinedRuleParameterException($paramKey);
        }

        return $this->parameters[$paramKey];
    }

    /**
     * @param Context $context
     *
     * @return int
     */
    abstract protected function run(Context $context) : int;
}