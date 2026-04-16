<?php

declare(strict_types=1);

namespace App\Task\Domain\Model;

final class EpicSummary
{
    public function __construct(
        public readonly int $id,
        public readonly string $title,
        public readonly int $storyCount,
    ) {}
}
