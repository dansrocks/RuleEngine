<?php


namespace Ruler;


interface IRuleEngine
{
    public function __construct(IRuleConfigurator $configurator, $ruleNames = [], $engineType = 'generic');

    public function getEngineType() : string;

    public function attach(string $ruleClassName);

    public function execute(Context $context);

    public function getResults() : array;
}