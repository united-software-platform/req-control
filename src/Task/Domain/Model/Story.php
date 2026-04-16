<?php

declare(strict_types=1);

namespace App\Task\Domain\Model;

final class Story
{
    public function __construct(
        public readonly int $id,
        public readonly int $epicId,
        public readonly string $title,
        public readonly ?string $description,
    ) {}
}
