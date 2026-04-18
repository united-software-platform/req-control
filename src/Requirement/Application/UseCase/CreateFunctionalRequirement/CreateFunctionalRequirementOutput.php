<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\CreateFunctionalRequirement;

final readonly class CreateFunctionalRequirementOutput
{
    public function __construct(
        public int $id,
        public string $code,
    ) {}
}
