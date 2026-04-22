<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\GetNonFunctionalRequirement;

use App\Requirement\Application\Dto\NonFunctionalRequirementDetail;

final readonly class GetNonFunctionalRequirementOutput
{
    public function __construct(
        public NonFunctionalRequirementDetail $requirement,
    ) {}
}
