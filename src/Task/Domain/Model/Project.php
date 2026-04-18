<?php

declare(strict_types=1);

namespace App\Task\Domain\Model;

final readonly class Project
{
    public function __construct(
        public int $id,
        public string $code,
    ) {}
}
