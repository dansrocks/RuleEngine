<?php

namespace Ruler\Exceptions;

/**
 * Class DisabledRuleCannotBeEvaluatedException
 *
 *
 * @package Ruler\Exceptions
 */
class DisabledRuleCannotBeEvaluatedException extends BaseException
{
    const CODE = 112;
    const MESSAGE = "Disabled rule cannot be evaluated";
}