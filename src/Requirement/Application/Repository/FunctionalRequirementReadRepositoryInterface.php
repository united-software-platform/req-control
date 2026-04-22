<?php

declare(strict_types=1);

namespace App\Requirement\Application\Repository;

use App\Requirement\Application\Dto\FunctionalRequirementDetail;
use App\Requirement\Domain\Model\FunctionalRequirement;

interface FunctionalRequirementReadRepositoryInterface
{
    /** @return list<FunctionalRequirement> */
    public function listByProjectId(int $projectId): array;

    public function findById(int $id): FunctionalRequirementDetail;
}
