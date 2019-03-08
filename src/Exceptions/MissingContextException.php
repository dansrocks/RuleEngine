<?php

namespace Ruler\Exceptions;

/**
 * Class MissingContextException
 *
 *
 * @package Ruler\Exceptions
 */
class MissingContextException extends BaseException
{
    const CODE = 100;
    const MESSAGE = "Missing context";
}