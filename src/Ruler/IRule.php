<?php

namespace Ruler;


interface IRule
{
    /**
     * @return string
     */
    public function getRuleName() : string;

    /**
     * @return array
     */
    public function getContextRequired() : array;

    /**
     * @param Context $context
     *
     * @return int
     */
    public function evaluate(Context $context) : int;
}