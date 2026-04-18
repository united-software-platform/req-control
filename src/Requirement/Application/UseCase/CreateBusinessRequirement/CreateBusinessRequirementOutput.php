<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\CreateBusinessRequirement;

final readonly class CreateBusinessRequirementOutput
{
    public function __construct(
        public int $id,
        public string $code,
    ) {}
}
