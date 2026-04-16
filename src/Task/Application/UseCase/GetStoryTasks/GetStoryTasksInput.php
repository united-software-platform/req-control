<?php

declare(strict_types=1);

namespace App\Task\Application\UseCase\GetStoryTasks;

final class GetStoryTasksInput
{
    public function __construct(
        public readonly int $storyId,
    ) {}
}
