<?php

namespace Ruler\Traits;

use Ruler\Exceptions\MissingParametersException;
use Ruler\Exceptions\InvalidRuleConfigurationException;
use Ruler\Exceptions\UndefinedRuleParameterException;

/**
 * Trait RuleSetupTrait
 *
 * @package Ruler\Traits
 */
trait RuleSetupTrait
{
    use RuleActivationTrait, RuleParametersTrait;

    /**
     * @param array $config
     *
     * @throws MissingParametersException
     *
     * @throws InvalidRuleConfigurationException
     */
    public function setupRule(array $config): void
    {
        $this->ruleEnabled = array_key_exists('enabled', $config)
            ? $config['enabled'] == true : false;

        $params = array_key_exists('params', $config) ? $config['params'] : [];
        if (!is_array($params)) {
            throw new InvalidRuleConfigurationException();
        }

        $this->setParameters($params);
    }

    /**
     * @return array
     *
     * @throws UndefinedRuleParameterException
     */
    public function getRuleSetup()
    {
        $params = array_fill_keys($this->getParametersRequired(), null);
        foreach ($params as $param => $value) {
            if ($this->hasParameter($param)) {
                $params[$param] = $this->getParameter($param);
            }
        }
        $config = [
            'enabled' => $this->isEnabled(),
            'params' => $params
        ];

        return $config;
    }
}
