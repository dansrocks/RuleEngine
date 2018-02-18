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
     * @inheritdoc
     */
    public function getRuleName(): string
    {
        return $this->ruleName;
    }

    /**
     *
     */
    private function setupRuleName()
    {
        if ($this->ruleName === null) {
            $className = $this->getShortClassName();
            $this->ruleName = substr($className, -4) === 'Rule'
                ? substr($className,0, strlen($className) - 4)
                : $className;
        }
    }

    /**
     * @return string
     */
    private function getShortClassName()
    {
        $parts = explode('\\', get_class($this));
        $shortClassName = array_pop($parts);

        return $shortClassName;
    }
}