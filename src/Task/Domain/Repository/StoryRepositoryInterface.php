<?php

declare(strict_types=1);

namespace App\Task\Domain\Repository;

use App\Task\Domain\Model\Story;
use App\Task\Domain\Model\StorySummary;

interface StoryRepositoryInterface
{
    public function create(int $projectId, string $code, int $epicId, string $title, ?string $description): Story;

    /** @return list<StorySummary> */
    public function listByEpicId(int $epicId): array;
}
