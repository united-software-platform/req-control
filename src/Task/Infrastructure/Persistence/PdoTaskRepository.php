<?php

declare(strict_types=1);

namespace App\Task\Infrastructure\Persistence;

use App\Task\Domain\Model\Task;
use App\Task\Domain\Model\TaskSummary;
use App\Task\Domain\Repository\TaskRepositoryInterface;
use PDO;

final class PdoTaskRepository implements TaskRepositoryInterface
{
    private const STATUS_NEW = 1;

    public function __construct(
        private readonly PDO $pdo,
    ) {}

    public function create(int $storyId, string $title, ?string $description): Task
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO core.tasks (story_id, title, description, status, readiness) VALUES (:story_id, :title, :description, :status, 0) RETURNING id, story_id, title, description, status, readiness',
        );
        $stmt->execute([
            'story_id' => $storyId,
            'title' => $title,
            'description' => $description,
            'status' => self::STATUS_NEW,
        ]);

        /** @var array{id: int, story_id: int, title: string, description: null|string, status: int, readiness: int} $row */
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return new Task(
            (int) $row['id'],
            (int) $row['story_id'],
            $row['title'],
            $row['description'],
            (int) $row['status'],
            (int) $row['readiness'],
        );
    }

    public function listByStoryId(int $storyId): array
    {
        $stmt = $this->pdo->prepare(
            'SELECT id, title, status, readiness
             FROM core.tasks
             WHERE story_id = :story_id
             ORDER BY id',
        );
        $stmt->execute(['story_id' => $storyId]);

        /** @var list<array{id: int, title: string, status: int, readiness: int}> $rows */
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(
            static fn (array $row) => new TaskSummary((int) $row['id'], $row['title'], (int) $row['status'], (int) $row['readiness']),
            $rows,
        );
    }
}
