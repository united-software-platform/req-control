<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\CreateNonFunctionalRequirement;

final readonly class CreateNonFunctionalRequirementOutput
{
    public function __construct(
        public int $id,
        public string $code,
    ) {}
}
