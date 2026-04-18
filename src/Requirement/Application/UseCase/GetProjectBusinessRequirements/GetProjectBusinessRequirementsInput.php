<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\GetProjectBusinessRequirements;

final readonly class GetProjectBusinessRequirementsInput
{
    public function __construct(
        public int $projectId,
    ) {}
}
