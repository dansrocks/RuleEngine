<?php

namespace Ruler\Traits;

use Ruler\Exceptions\MissingParametersException;
use Ruler\Exceptions\UndefinedRuleParameterException;

/**
 * Trait RuleParametersTrait
 *
 * @package Ruler\Traits
 */
trait RuleParametersTrait
{
    protected $parameterKeys = [];

    private $parametersValues = [];

    /**
     * @param string $paramKey
     *
     * @return mixed
     *
     * @throws UndefinedRuleParameterException
     */
    public function getParameter(string $paramKey)
    {
        if (! in_array($paramKey, $this->parameterKeys)) {
            throw new UndefinedRuleParameterException($paramKey);
        }

        return $this->parametersValues[$paramKey];
    }

    /**
     * @inheritdoc
     */
    public function getParametersRequired(): array
    {
        return $this->parameterKeys;
    }

    /**
     * @param array $parameters
     *
     * @throws MissingParametersException
     */
    protected function setParameters(array $parameters)
    {
        $parametersRequired = $this->getParametersRequired();

        $missingParameters = array_diff($parametersRequired, array_keys($parameters));
        if (! empty($missingParameters)) {
            throw new MissingParametersException(implode(', ', $missingParameters));
        }

        foreach ($parametersRequired as $parameterName) {
            if (array_key_exists($parameterName, $parameters)) {
                $this->parametersValues[$parameterName] = $parameters[$parameterName];
            }
        }
    }

    /**
     * @param string $paramKey
     *
     * @return bool
     */
    protected function hasParameter(string $paramKey) : bool
    {
        return array_key_exists($paramKey, $this->parametersValues);
    }
}