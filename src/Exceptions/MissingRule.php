<?php

namespace Ruler\Exceptions;

/**
 * Class MissingRule
 *
 * @package Ruler\Exceptions
 */
class MissingRule extends BaseException
{
    const CODE = 201;
    const MESSAGE = "Missing rule: Class not found";
}