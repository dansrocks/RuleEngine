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
    protected $ruleEnabled;

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->ruleEnabled;
    }
}