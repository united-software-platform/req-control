<?php

declare(strict_types=1);

namespace App\Task\Infrastructure\Persistence;

use App\Task\Domain\Model\Epic;
use App\Task\Domain\Model\EpicSummary;
use App\Task\Domain\Repository\EpicRepositoryInterface;
use PDO;

final readonly class PdoEpicRepository implements EpicRepositoryInterface
{
    public function __construct(
        private PDO $pdo,
    ) {}

    public function create(int $projectId, string $code, string $title, ?string $description): Epic
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO core.epics (code, title, description) VALUES (:code, :title, :description) RETURNING id, code, title, description',
        );
        $stmt->execute(['code' => $code, 'title' => $title, 'description' => $description]);

        /** @var array{id: int, code: string, title: string, description: null|string} $row */
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->pdo->prepare(
            'INSERT INTO core.project_entities (project_id, entity_type_id, entity_id)
             SELECT :project_id, et.id, :entity_id FROM core.entity_types et WHERE et.type = \'epic\'',
        )->execute(['project_id' => $projectId, 'entity_id' => $row['id']]);

        return new Epic((int) $row['id'], $row['code'], $row['title'], $row['description']);
    }

    public function listAll(): array
    {
        $stmt = $this->pdo->query(
            'SELECT e.id, e.title, COUNT(s.id) AS story_count
             FROM core.epics e
             LEFT JOIN core.stories s ON s.epic_id = e.id
             GROUP BY e.id, e.title
             ORDER BY e.id',
        );

        /** @var list<array{id: int, title: string, story_count: int}> $rows */
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(
            static fn (array $row) => new EpicSummary((int) $row['id'], $row['title'], (int) $row['story_count']),
            $rows,
        );
    }
}
