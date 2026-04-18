<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\GetBusinessRequirement;

final readonly class GetBusinessRequirementInput
{
    public function __construct(
        public int $requirementId,
    ) {}
}
