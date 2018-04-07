<?php

namespace Ruler;

/**
 * Interface IRuleResult
 *
 * @package Ruler
 */
interface IRuleResult
{
    public function __construct(string $ruleName, bool $isEnabled, $result = null);

    public function getRuleName(): string;

    public function isEnabled(): bool;

    public function getResult();
}