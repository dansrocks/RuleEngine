<?php

namespace Ruler;

/**
 * Class RuleValue
 *
 * @package Ruler
 */
class RuleValue implements IRuleValue
{
    private $type;
    private $value;

    /**
     * RuleValue constructor.
     *
     * @param $value
     */
    public function __construct($value)
    {
        $this->type = gettype($value);
        $this->value = $value;
    }

    /**
     * @inheritdoc
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}