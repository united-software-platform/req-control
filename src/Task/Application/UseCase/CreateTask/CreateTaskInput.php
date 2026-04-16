<?php

declare(strict_types=1);

namespace App\Task\Application\UseCase\CreateTask;

final class CreateTaskInput
{
    public function __construct(
        public readonly int $storyId,
        public readonly string $title,
        public readonly ?string $description,
    ) {}
}
