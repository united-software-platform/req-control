<?php

declare(strict_types=1);

namespace App\Task\Application\UseCase\CreateStory;

final class CreateStoryInput
{
    public function __construct(
        public readonly int $epicId,
        public readonly string $title,
        public readonly ?string $description,
    ) {}
}
