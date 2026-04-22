<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\GetNonFunctionalRequirement;

final readonly class GetNonFunctionalRequirementInput
{
    public function __construct(
        public int $requirementId,
    ) {}
}
