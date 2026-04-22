<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\GetProjectFunctionalRequirements;

final readonly class GetProjectFunctionalRequirementsInput
{
    public function __construct(
        public int $projectId,
    ) {}
}
