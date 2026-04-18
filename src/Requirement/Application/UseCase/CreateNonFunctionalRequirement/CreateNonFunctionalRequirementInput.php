<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\CreateNonFunctionalRequirement;

use App\Requirement\Domain\Model\NonFunctionalRequirementType;

final readonly class CreateNonFunctionalRequirementInput
{
    public function __construct(
        public int $projectId,
        public NonFunctionalRequirementType $type,
        public string $description,
        public ?string $acceptanceCriteria,
    ) {}
}
