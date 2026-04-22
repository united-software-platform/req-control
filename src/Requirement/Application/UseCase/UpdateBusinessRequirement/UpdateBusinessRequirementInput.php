<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\UpdateBusinessRequirement;

final readonly class UpdateBusinessRequirementInput
{
    public function __construct(
        public int $requirementId,
        public string $description,
    ) {}
}
