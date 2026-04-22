<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\GetFunctionalRequirement;

final readonly class GetFunctionalRequirementInput
{
    public function __construct(
        public int $requirementId,
    ) {}
}
