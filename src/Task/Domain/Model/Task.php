<?php

declare(strict_types=1);

namespace App\Task\Domain\Model;

final class Task
{
    public function __construct(
        public readonly int $id,
        public readonly int $storyId,
        public readonly string $title,
        public readonly ?string $description,
        public readonly int $status,
        public readonly int $readiness,
    ) {}
}
