<?php

namespace Ruler;

use Ruler\Exceptions\InvalidRuleConfiguration;
use Ruler\Exceptions\InvalidRuleConfigurationException;
use Ruler\Exceptions\MissingParametersException;
use Ruler\Exceptions\MissingRule;


/**
 * Class RuleEngine
 *
 * @package Ruler
 */
class RuleEngine implements IRuleEngine
{
    /** @var IRule[] */
    protected $rules;

    /** @var IRuleConfigurator */
    protected $configurator;

    /** @var string|null  Kind of RuleEngine */
    protected $engineType = 'generic';

    /** @var array */
    protected $results = [];

    /**
     * RuleEngine constructor.
     *
     * @param IRuleConfigurator $configurator
     * @param array $rulesNames
     * @param string $engineType
     *
     * @throws InvalidRuleConfiguration
     * @throws MissingRule
     */
    public function __construct(IRuleConfigurator $configurator, $rulesNames = [], $engineType = 'generic')
    {
        $this->configurator = $configurator;
        $this->engineType = $engineType;
        $this->rules = $this->buildRules($rulesNames);
    }

    /**
     * @param string $ruleClassName
     *
     * @throws InvalidRuleConfiguration
     * @throws MissingRule
     */
    public function attach(string $ruleClassName)
    {
        $this->rules[$ruleClassName] = $this->instantiateRule($ruleClassName);
    }


    /**
     * @param Context $context
     */
    public function execute(Context $context)
    {
        foreach ($this->getRules() as $rule) {
            $result = ($rule->isEnabled())
                ? new RuleResult($rule->getRuleName(), true, $rule->evaluate($context))
                : new RuleResult($rule->getRuleName(), false);
            $this->addResult($result);
        }
    }

    /**
     * @return IRuleResult[]
     */
    public function getResults(): array
    {
        return $this->results;
    }


    /**
     * @return string
     */
    public function getEngineType(): string
    {
        return $this->engineType;
    }


    /**
     * @param array $rulesNames
     *
     * @return array
     *
     * @throws InvalidRuleConfiguration
     * @throws MissingRule
     */
    private function buildRules(array $rulesNames): array
    {
        $rules = [];
        foreach ($rulesNames as $ruleName) {
            $rules[$ruleName] = $this->instantiateRule($ruleName);
        }
        return $rules;
    }

    /**
     * @param string $ruleClassName
     *
     * @return IRule
     *
     * @throws InvalidRuleConfiguration
     * @throws MissingRule
     */
    private function instantiateRule(string $ruleClassName): IRule
    {
        if (!class_exists($ruleClassName) || !in_array(IRule::class, class_implements($ruleClassName))) {
            throw new MissingRule($ruleClassName);
        }

//        try {
//            /** @var IRule $rule */
            $rule = new $ruleClassName($this->configurator->getConfig($ruleClassName));

//        } catch (MissingParametersException $exception) {
//            throw new InvalidRuleConfiguration(sprintf("%s - %s", $ruleClassName, $exception->getMessage()));
//
//        } catch (InvalidRuleConfigurationException $exception) {
//            throw new InvalidRuleConfiguration($ruleClassName);
//        }

        return $rule;
    }

    /**
     * @param IRuleResult $result
     */
    private function addResult(IRuleResult $result)
    {
        $this->results[$result->getRuleName()] = $result;
    }

    /**
     * @return IRule[]
     */
    private function getRules() : array
    {
        return $this->rules;
    }
}
