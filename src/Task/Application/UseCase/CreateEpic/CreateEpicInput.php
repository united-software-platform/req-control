<?php

declare(strict_types=1);

namespace App\Task\Application\UseCase\CreateEpic;

final class CreateEpicInput
{
    public function __construct(
        public readonly string $title,
        public readonly ?string $description,
    ) {}
}
