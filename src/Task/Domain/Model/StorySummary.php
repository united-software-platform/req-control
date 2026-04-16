<?php

declare(strict_types=1);

namespace App\Task\Domain\Model;

final class StorySummary
{
    public function __construct(
        public readonly int $id,
        public readonly string $title,
        public readonly int $avgReadiness,
    ) {}
}
