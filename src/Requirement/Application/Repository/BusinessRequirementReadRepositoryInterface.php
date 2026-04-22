<?php

declare(strict_types=1);

namespace App\Requirement\Application\Repository;

use App\Requirement\Application\Dto\BusinessRequirementDetail;
use App\Requirement\Domain\Model\BusinessRequirement;

interface BusinessRequirementReadRepositoryInterface
{
    /** @return list<BusinessRequirement> */
    public function listByProjectId(int $projectId): array;

    public function findById(int $id): BusinessRequirementDetail;
}
