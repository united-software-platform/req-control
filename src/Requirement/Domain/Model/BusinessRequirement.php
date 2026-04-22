<?php

declare(strict_types=1);

namespace App\Requirement\Domain\Model;

final readonly class BusinessRequirement
{
    public function __construct(
        public int $id,
        public string $code,
        public string $description,
    ) {}
}
