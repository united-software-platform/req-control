<?php

declare(strict_types=1);

namespace App\Task\Application\UseCase\CreateEpic;

final readonly class CreateEpicInput
{
    public function __construct(
        public int $projectId,
        public string $title,
        public ?string $description,
    ) {}
}
