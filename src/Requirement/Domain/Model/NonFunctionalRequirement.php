<?php

declare(strict_types=1);

namespace App\Requirement\Domain\Model;

final readonly class NonFunctionalRequirement
{
    public function __construct(
        public int $id,
        public string $code,
        public NonFunctionalRequirementType $type,
        public string $description,
        public ?string $acceptanceCriteria = null,
    ) {}
}
