<?php

namespace Ruler;

use Ruler\Exceptions\InvalidRuleConfigurationException;
use Ruler\Exceptions\MissingContextException;
use Ruler\Traits\RuleActivationTrait;
use Ruler\Traits\RuleContextTrait;
use Ruler\Traits\RuleNameTrait;
use Ruler\Traits\RuleParametersTrait;

/**
 * Class AbstractRule
 *
 * @package Ruler
 */
abstract class AbstractRule implements IRule
{
    use RuleActivationTrait, RuleNameTrait, RuleParametersTrait, RuleContextTrait;

    /**
     * Constructor.
     *
     * @param array $config
     *
     * @throws Exceptions\MissingParametersException
     * @throws InvalidRuleConfigurationException
     */
    public function __construct(array $config)
    {
        $this->setupRuleName();

        $this->ruleEnabled = array_key_exists('enabled', $config)
            ? $config['enabled'] == true : false;

        $params = array_key_exists('params', $config) ? $config['params'] : [];
        if (! is_array($params)) {
            throw new InvalidRuleConfigurationException();
        }

        $this->setParameterKeys($params);
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
     * @return int
     */
    abstract protected function run(Context $context) : int;
}