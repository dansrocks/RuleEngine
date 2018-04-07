<?php


namespace Ruler;

/**
 * Interface IRuleConfigurator
 * @package Ruler
 */
interface IRuleConfigurator
{
    public function getConfig(string $ruleClassname) : array;
}