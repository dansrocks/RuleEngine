<?php

namespace Ruler;

/**
 * Class RuleConfigurator
 *
 * @package Ruler
 */
class RuleConfigurator implements IRuleConfigurator
{
    private $rulesConfig;

    /**
     * RuleConfigurator constructor.
     *
     * @param array $rulesConfig
     */
    public function __construct(array $rulesConfig)
    {
        $this->rulesConfig = $rulesConfig;
    }

    /**
     * @param string $ruleClassname
     *
     * @return array
     */
    public function getConfig(string $ruleClassname): array
    {
        return array_key_exists($ruleClassname, $this->rulesConfig)
            ? $this->rulesConfig[$ruleClassname]
            : [];
    }
}