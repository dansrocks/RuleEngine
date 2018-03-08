<?php

namespace Ruler\Exceptions;

/**
 * Class InvalidRuleConfigurationException
 *
 *
 * @package Ruler\Exceptions
 */
class InvalidRuleConfigurationException extends BaseException
{
    const CODE = 108;
    const MESSAGE = "Invalid configuration for rule";
}