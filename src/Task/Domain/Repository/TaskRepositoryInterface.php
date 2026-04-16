<?php

declare(strict_types=1);

namespace App\Task\Domain\Repository;

use App\Task\Domain\Model\Task;
use App\Task\Domain\Model\TaskSummary;

interface TaskRepositoryInterface
{
    public function create(int $storyId, string $title, ?string $description): Task;

    /** @return list<TaskSummary> */
    public function listByStoryId(int $storyId): array;
}
