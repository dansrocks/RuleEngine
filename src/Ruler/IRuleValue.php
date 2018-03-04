<?php

namespace Ruler;

/**
 * Interface IRuleValue
 *
 * @package Ruler
 */
interface IRuleValue
{
    /**
     * @return string
     */
    public function getType() : string;

    /**
     * @return mixed
     */
    public function getValue();
}