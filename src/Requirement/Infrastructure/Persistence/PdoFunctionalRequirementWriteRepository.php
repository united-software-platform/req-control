<?php

declare(strict_types=1);

namespace App\Requirement\Infrastructure\Persistence;

use App\Requirement\Domain\Model\FunctionalRequirement;
use App\Requirement\Domain\Repository\FunctionalRequirementWriteRepositoryInterface;
use PDO;

final readonly class PdoFunctionalRequirementWriteRepository implements FunctionalRequirementWriteRepositoryInterface
{
    public function __construct(
        private PDO $pdo,
    ) {}

    public function create(FunctionalRequirement $requirement): FunctionalRequirement
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO core.functional_requirements (code, description) VALUES (:code, :description)
             RETURNING id, code, description',
        );
        $stmt->execute(['code' => $requirement->code, 'description' => $requirement->description]);

        /** @var array{id: int, code: string, description: string} $row */
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return new FunctionalRequirement((int) $row['id'], $row['code'], $row['description']);
    }

    public function update(FunctionalRequirement $requirement): void
    {
        $this->pdo->prepare(
            'UPDATE core.functional_requirements SET description = :description, updated_at = now() WHERE id = :id',
        )->execute(['description' => $requirement->description, 'id' => $requirement->id]);
    }
}
