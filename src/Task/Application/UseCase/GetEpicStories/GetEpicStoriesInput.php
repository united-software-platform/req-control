<?php

declare(strict_types=1);

namespace App\Task\Application\UseCase\GetEpicStories;

final class GetEpicStoriesInput
{
    public function __construct(
        public readonly int $epicId,
    ) {}
}
