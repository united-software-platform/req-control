<?php

declare(strict_types=1);

namespace App\Requirement\Domain\Model;

final readonly class RequirementTaskSummary
{
    public function __construct(
        public int $id,
        public int $status,
    ) {}
}
