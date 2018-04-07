<?php

namespace Ruler\Exceptions;

/**
 * Class InvalidRuleConfiguration
 *
 * @package Ruler\Exceptions
 */
class InvalidRuleConfiguration extends BaseException
{
    const CODE = 205;
    const MESSAGE = "Invalid or missing configuration for rule ";
}