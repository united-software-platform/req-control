<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\UpdateFunctionalRequirementDescription;

final readonly class UpdateFunctionalRequirementDescriptionInput
{
    public function __construct(
        public int $requirementId,
        public string $description,
    ) {}
}
