<?php

namespace Ruler;

use Ruler\Exceptions\DisabledRuleCannotBeEvaluatedException;
use Ruler\Exceptions\InvalidRuleConfigurationException;
use Ruler\Exceptions\MissingContextException;
use Ruler\Traits\RuleContextTrait;
use Ruler\Traits\RuleNameTrait;
use Ruler\Traits\RuleSetupTrait;

/**
 * Class AbstractRule
 *
 * @package Ruler
 */
abstract class AbstractRule implements IRule
{
    use
        RuleContextTrait,
        RuleNameTrait,
        RuleSetupTrait
        ;

    /**
     * AbstractRule constructor.
     *
     * @param array $config
     *
     * @throws Exceptions\MissingParametersException
     *
     * @throws InvalidRuleConfigurationException
     */
    public function __construct(array $config = [])
    {
        $this->assignRuleName($this->generateRuleNameFromClassName());

        if (! empty($config)) {
            $this->setupRule($config);
        }
    }

    /**
     * @param Context $context
     *
     * @return IRuleValue
     *
     * @throws DisabledRuleCannotBeEvaluatedException
     * @throws MissingContextException
     */
    final public function evaluate(Context $context): IRuleValue
    {
        if (false === $this->isEnabled()) {
            throw new DisabledRuleCannotBeEvaluatedException();
        }

        $this->checkContext($context);

        return new RuleValue($this->run($context));
    }

    /**
     * @param Context $context
     *
     * @return mixed
     */
    abstract protected function run(Context $context);
}