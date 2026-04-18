<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence;

use App\Shared\Application\Service\CodeGeneratorInterface;
use App\Shared\Domain\Service\EntityCodeGenerator;
use InvalidArgumentException;
use PDO;

final readonly class PostgresCodeGenerator implements CodeGeneratorInterface
{
    public function __construct(
        private PDO $pdo,
        private EntityCodeGenerator $generator,
    ) {}

    public function generate(string $projectCode, string $entityType): string
    {
        $sequenceName = $this->buildSequenceName($projectCode, $entityType);

        $this->pdo->exec("CREATE SEQUENCE IF NOT EXISTS {$sequenceName}");

        /** @var int $nextVal */
        $nextVal = $this->pdo->query("SELECT nextval('{$sequenceName}')")->fetchColumn();

        return ($this->generator)($projectCode, $entityType, (int) $nextVal);
    }

    private function buildSequenceName(string $projectCode, string $entityType): string
    {
        if (!preg_match('/^[a-zA-Z0-9_-]+$/', $projectCode)) {
            throw new InvalidArgumentException("Invalid projectCode: {$projectCode}");
        }

        if (!preg_match('/^[a-zA-Z0-9_-]+$/', $entityType)) {
            throw new InvalidArgumentException("Invalid entityType: {$entityType}");
        }

        $safeCode = strtolower(str_replace('-', '_', $projectCode));
        $safeType = strtolower(str_replace('-', '_', $entityType));

        return "core.entity_code_{$safeCode}_{$safeType}_seq";
    }
}
