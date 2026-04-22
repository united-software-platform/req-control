<?php

declare(strict_types=1);

namespace App\Requirement\Application\Repository;

use App\Requirement\Domain\Model\RequirementEntityType;

interface RequirementEntityLinkRepositoryInterface
{
    public function link(int $projectId, int $entityId, RequirementEntityType $entityType): void;
}
