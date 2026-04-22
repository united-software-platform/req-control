<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\GetProjectFunctionalRequirements;

use App\Requirement\Domain\Model\FunctionalRequirement;

final readonly class GetProjectFunctionalRequirementsOutput
{
    public function __construct(
        /** @var list<FunctionalRequirement> */
        public array $requirements,
    ) {}
}
