<?php

declare(strict_types=1);

namespace App\Shared\Domain\Service;

use InvalidArgumentException;

final class EntityCodeGenerator
{
    public function __invoke(string $projectCode, string $entityType, int $id): string
    {
        if (mb_strlen($projectCode) > 4) {
            throw new InvalidArgumentException(
                sprintf('projectCode must be 4 characters or less, "%s" given', $projectCode),
            );
        }

        return sprintf('%s-%s-%d', $projectCode, $entityType, $id);
    }
}
