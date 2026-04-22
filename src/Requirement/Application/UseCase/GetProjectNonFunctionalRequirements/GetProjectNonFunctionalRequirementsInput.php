<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\GetProjectNonFunctionalRequirements;

final readonly class GetProjectNonFunctionalRequirementsInput
{
    public function __construct(
        public int $projectId,
    ) {}
}
