<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\UpdateFunctionalRequirement;

final readonly class UpdateFunctionalRequirementInput
{
    public function __construct(
        public int $requirementId,
        public string $description,
    ) {}
}
