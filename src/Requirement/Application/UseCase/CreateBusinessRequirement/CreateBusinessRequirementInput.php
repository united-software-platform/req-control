<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\CreateBusinessRequirement;

final readonly class CreateBusinessRequirementInput
{
    public function __construct(
        public int $projectId,
        public string $description,
    ) {}
}
