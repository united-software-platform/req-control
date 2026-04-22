<?php

declare(strict_types=1);

namespace App\Requirement\Infrastructure\Persistence;

use App\Requirement\Application\Repository\RequirementEntityLinkRepositoryInterface;
use App\Requirement\Domain\Model\RequirementEntityType;
use PDO;

final readonly class PdoRequirementEntityLinkRepository implements RequirementEntityLinkRepositoryInterface
{
    public function __construct(
        private PDO $pdo,
    ) {}

    public function link(int $projectId, int $entityId, RequirementEntityType $entityType): void
    {
        $this->pdo->prepare(
            'INSERT INTO core.project_entities (project_id, entity_type_id, entity_id)
             SELECT :project_id, et.id, :entity_id FROM core.entity_types et WHERE et.type = :entity_type',
        )->execute([
            'project_id' => $projectId,
            'entity_id' => $entityId,
            'entity_type' => $entityType->value,
        ]);
    }
}
