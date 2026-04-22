<?php

declare(strict_types=1);

namespace App\Requirement\Application\Repository;

use App\Requirement\Application\Dto\NonFunctionalRequirementDetail;
use App\Requirement\Domain\Model\NonFunctionalRequirement;

interface NonFunctionalRequirementReadRepositoryInterface
{
    /** @return list<NonFunctionalRequirement> */
    public function listByProjectId(int $projectId): array;

    public function findById(int $id): NonFunctionalRequirementDetail;
}
