<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\GetProjectNonFunctionalRequirements;

use App\Requirement\Domain\Model\NonFunctionalRequirement;

final readonly class GetProjectNonFunctionalRequirementsOutput
{
    public function __construct(
        /** @var list<NonFunctionalRequirement> */
        public array $requirements,
    ) {}
}
