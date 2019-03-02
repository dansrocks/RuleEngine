<?php

namespace Ruler\Traits;

/**
 * Trait RuleNameTrait
 *
 * @package Ruler\Traits
 */
trait RuleNameTrait
{
    /** @var string|null  */
    private $ruleName = null;

     /**
     * @return string
     */
    public function getRuleName(): string
    {
        return $this->ruleName;
    }

    /**
     * No doc
     */
    private function assignRuleName(string $rulename)
    {
        $this->ruleName = $rulename;
    }

    /**
     * @return string
     */
    private function generateRuleNameFromClassName()
    {
        $parts = explode('\\', get_class($this));
        $className = array_pop($parts);

        $ruleName = substr($className, -4) === 'Rule'
            ? substr($className,0, strlen($className) - 4)
            : $className;

        return $ruleName;
    }
}