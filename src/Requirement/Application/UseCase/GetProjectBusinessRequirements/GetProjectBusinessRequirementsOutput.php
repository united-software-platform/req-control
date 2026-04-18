<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\GetProjectBusinessRequirements;

use App\Requirement\Domain\Model\BusinessRequirement;

final readonly class GetProjectBusinessRequirementsOutput
{
    public function __construct(
        /** @var list<BusinessRequirement> */
        public array $requirements,
    ) {}
}
