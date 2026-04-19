<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\UpdateNonFunctionalRequirement;

use App\Requirement\Domain\Model\NonFunctionalRequirementType;

final readonly class UpdateNonFunctionalRequirementInput
{
    public function __construct(
        public int $requirementId,
        public ?string $description = null,
        public ?NonFunctionalRequirementType $type = null,
        public ?string $acceptanceCriteria = null,
    ) {}
}
