<?php

declare(strict_types=1);

namespace App\Requirement\Domain\Repository;

use App\Requirement\Domain\Model\BusinessRequirement;

interface BusinessRequirementWriteRepositoryInterface
{
    public function create(BusinessRequirement $requirement): BusinessRequirement;

    public function update(BusinessRequirement $requirement): void;
}
