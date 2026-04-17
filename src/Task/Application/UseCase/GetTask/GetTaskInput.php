<?php

declare(strict_types=1);

namespace App\Task\Application\UseCase\GetTask;

final class GetTaskInput
{
    public function __construct(
        public readonly int $taskId,
    ) {}
}
