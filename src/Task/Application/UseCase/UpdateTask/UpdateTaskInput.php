<?php

declare(strict_types=1);

namespace App\Task\Application\UseCase\UpdateTask;

final class UpdateTaskInput
{
    public function __construct(
        public readonly int $taskId,
        public readonly ?string $title = null,
        public readonly ?string $description = null,
        public readonly ?int $readiness = null,
        public readonly ?int $status = null,
    ) {}
}
