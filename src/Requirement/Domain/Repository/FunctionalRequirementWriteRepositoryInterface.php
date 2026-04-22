<?php

declare(strict_types=1);

namespace App\Requirement\Domain\Repository;

use App\Requirement\Domain\Model\FunctionalRequirement;

interface FunctionalRequirementWriteRepositoryInterface
{
    public function create(FunctionalRequirement $requirement): FunctionalRequirement;

    public function update(FunctionalRequirement $requirement): void;
}
