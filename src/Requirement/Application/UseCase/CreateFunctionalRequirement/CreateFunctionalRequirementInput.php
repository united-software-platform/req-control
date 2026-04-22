<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\CreateFunctionalRequirement;

final readonly class CreateFunctionalRequirementInput
{
    public function __construct(
        public int $projectId,
        public string $description,
    ) {}
}
