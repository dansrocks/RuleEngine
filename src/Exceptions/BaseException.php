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

    /**
     * BaseException constructor
     * .
     * @param string $text
     */
    public function __construct(string $text = '')
    {
        parent::__construct($this->generateErrorMessage($text), static::CODE, null);
    }

    /**
     * @param string $text
     *
     * @return string
     */
    private function generateErrorMessage(string $text)
    {
        $message = static::MESSAGE;
        if (! empty($text)) {
            $message .= sprintf(" (%s)", $text);
        }

        return $message;
    }
}