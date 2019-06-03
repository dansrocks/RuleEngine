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
    const CONTEXT_REQUIRED = 'required';
    const CONTEXT_OPTIONAL = 'optional';

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
     * @param bool $includeOptional
     *
     * @return array
     */
    public function getContextRequired(bool $includeOptional = true) : array;

    /**
     * @param Context $context
     *
     * @return bool
     */
    public function isExcluded(Context $context) : bool;

    /**
     * @param Context $context
     *
     * @return IRuleValue
     */
    public function evaluate(Context $context) : IRuleValue;
}