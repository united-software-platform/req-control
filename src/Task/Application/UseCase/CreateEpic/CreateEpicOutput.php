<?php

declare(strict_types=1);

namespace App\Task\Application\UseCase\CreateEpic;

final class CreateEpicOutput
{
    public function __construct(
        public readonly int $id,
        public readonly string $title,
    ) {}
}
