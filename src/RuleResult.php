<?php

namespace Ruler;

/**
 * Class RuleResult
 *
 * @package Ruler
 */
class RuleResult implements IRuleResult
{
    /** @var string */
    public $ruleName;

    /** @var bool */
    public $enabled;

    /** @var mixed|null */
    public $result;

    /**
     * RuleResult constructor.
     * @param string $ruleName
     * @param bool $isEnabled
     * @param mixed|null $result
     */
    public function __construct(string $ruleName, bool $isEnabled, $result = null)
    {
        $this->ruleName = $ruleName;
        $this->enabled = $isEnabled ? 1: 0;
        $this->result = $result;
    }

    /**
     * @return string
     */
    public function getRuleName(): string
    {
        return $this->ruleName;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @return mixed|null
     */
    public function getResult()
    {
        return $this->result;
    }
}