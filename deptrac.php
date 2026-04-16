<?php

declare(strict_types=1);

use Qossmic\Deptrac\Contract\Config\Collector\ClassNameRegexConfig;
use Qossmic\Deptrac\Contract\Config\DeptracConfig;
use Qossmic\Deptrac\Contract\Config\Layer;
use Qossmic\Deptrac\Contract\Config\Ruleset;

return static function (DeptracConfig $deptrac): void {
    $domain = Layer::withName('Domain')
        ->collectors(
            ClassNameRegexConfig::create('#App\\\\[^\\\\]+\\\\Domain\\\\#'),
        );

    $application = Layer::withName('Application')
        ->collectors(
            ClassNameRegexConfig::create('#App\\\\[^\\\\]+\\\\Application\\\\#'),
        );

    $infrastructure = Layer::withName('Infrastructure')
        ->collectors(
            ClassNameRegexConfig::create('#App\\\\[^\\\\]+\\\\Infrastructure\\\\#'),
        );

    $deptrac
        ->paths('src')
        ->layers($domain, $application, $infrastructure)
        ->rulesets(
            Ruleset::forLayer($domain),
            Ruleset::forLayer($application)->accesses($domain),
            Ruleset::forLayer($infrastructure)->accesses($domain, $application),
        );
};