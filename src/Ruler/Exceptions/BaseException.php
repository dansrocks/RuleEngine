<?php

namespace Ruler\Exceptions;

/**
 * Class BaseException
 *
 * @package Ruler\Exceptions
 */
class BaseException extends \Exception
{
    const CODE = 0;
    const MESSAGE = "Unnamed exception";

    public function __construct()
    {
        parent::__construct(self::MESSAGE, self::CODE, null);
    }
}