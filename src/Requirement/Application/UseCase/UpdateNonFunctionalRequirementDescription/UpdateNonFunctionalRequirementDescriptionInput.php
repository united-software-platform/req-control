<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\UpdateNonFunctionalRequirementDescription;

final readonly class UpdateNonFunctionalRequirementDescriptionInput
{
    public function __construct(
        public int $requirementId,
        public string $description,
    ) {}
}
