<?php

declare(strict_types=1);

namespace App\Task\Application\UseCase\GetStoryTasks;

use App\Task\Domain\Model\TaskSummary;

final class GetStoryTasksOutput
{
    public function __construct(
        /** @var list<TaskSummary> */
        public readonly array $tasks,
    ) {}
}
