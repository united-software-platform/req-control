<?php

declare(strict_types=1);

namespace App\Requirement\Domain\Repository;

use App\Requirement\Domain\Model\NonFunctionalRequirement;
use App\Requirement\Domain\Model\NonFunctionalRequirementDetail;
use App\Requirement\Domain\Model\NonFunctionalRequirementType;

interface NonFunctionalRequirementRepositoryInterface
{
    /** @return list<NonFunctionalRequirement> */
    public function listByProjectId(int $projectId): array;

    public function findById(int $id): NonFunctionalRequirementDetail;

    public function create(int $projectId, NonFunctionalRequirementType $type, string $description, ?string $acceptanceCriteria): NonFunctionalRequirement;

    public function updateDescription(int $id, string $description): void;
}
