<?php

declare(strict_types=1);

namespace App\Requirement\Domain\Repository;

use App\Requirement\Domain\Model\NonFunctionalRequirement;

interface NonFunctionalRequirementWriteRepositoryInterface
{
    public function create(NonFunctionalRequirement $requirement): NonFunctionalRequirement;

    public function update(NonFunctionalRequirement $requirement): void;
}
