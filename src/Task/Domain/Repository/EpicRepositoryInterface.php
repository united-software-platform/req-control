<?php

declare(strict_types=1);

namespace App\Task\Domain\Repository;

use App\Task\Domain\Model\Epic;
use App\Task\Domain\Model\EpicSummary;

interface EpicRepositoryInterface
{
    public function create(string $title, ?string $description): Epic;

    /** @return list<EpicSummary> */
    public function listAll(): array;
}
