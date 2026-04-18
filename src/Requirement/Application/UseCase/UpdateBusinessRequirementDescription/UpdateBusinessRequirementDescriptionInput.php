<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\UpdateBusinessRequirementDescription;

final readonly class UpdateBusinessRequirementDescriptionInput
{
    public function __construct(
        public int $requirementId,
        public string $description,
    ) {}
}
