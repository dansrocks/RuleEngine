<?php

namespace Ruler\Traits;

/**
 * Trait RuleActivationTrait
 *
 * @package Ruler\Traits
 */
trait RuleActivationTrait
{
    /**
     * @var bool
     */
    protected $ruleEnabled = false;

    /**
     * Returns true when rule is enabled
     *
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->ruleEnabled;
    }

    /**
     * Enable the rule
     */
    public function enable()
    {
        $this->ruleEnabled = true;
    }

    /**
     * Disable the rule
     */
    public function disable()
    {
        $this->ruleEnabled = false;
    }
}