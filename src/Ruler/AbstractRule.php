<?php

namespace Ruler;

use Ruler\Exceptions\MissingContextException;
use Ruler\Traits\RuleContextTrait;
use Ruler\Traits\RuleNameTrait;
use Ruler\Traits\RuleParametersTrait;

/**
 * Class AbstractRule
 *
 * @package Ruler
 */
abstract class AbstractRule implements IRule
{
    use RuleNameTrait, RuleParametersTrait, RuleContextTrait;

    /**
     * Constructor.
     *
     * @param array $parameters
     *
     * @throws Exceptions\MissingParametersException
     */
    public function __construct($parameters = [])
    {
        $this->setupRuleName();
        $this->setParameterKeys($parameters);
    }

    /**
     * @param Context $context
     *
     * @return int
     *
     * @throws MissingContextException
     */
    final public function evaluate(Context $context): int
    {
        $this->checkContext($context);

        return $this->run($context);
    }

    /**
     * @param Context $context
     *
     * @return int
     */
    abstract protected function run(Context $context) : int;
}