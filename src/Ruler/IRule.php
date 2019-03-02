<?php

namespace Ruler;

use Ruler\Exceptions\UndefinedRuleParameterException;

/**
 * Interface IRule
 *
 * @package Ruler
 */
interface IRule
{
    /**
     * @return string
     */
    public function getRuleName() : string;

    /**
     * @return bool
     */
    public function isEnabled() : bool;

    /**
     * @return array
     */
    public function getParametersRequired() : array;

    /**
     * @param string $paramKey
     *
     * @return mixed
     *
     * @throws UndefinedRuleParameterException
     */
    public function getParameter(string $paramKey);

    /**
     * @return array
     */
    public function getContextRequired() : array;

    /**
     * @param Context $context
     *
     * @return IRuleValue
     */
    public function evaluate(Context $context) : IRuleValue;
}