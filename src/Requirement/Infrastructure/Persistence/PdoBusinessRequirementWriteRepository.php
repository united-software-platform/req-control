<?php

declare(strict_types=1);

namespace App\Requirement\Infrastructure\Persistence;

use App\Requirement\Domain\Model\BusinessRequirement;
use App\Requirement\Domain\Repository\BusinessRequirementWriteRepositoryInterface;
use PDO;

final readonly class PdoBusinessRequirementWriteRepository implements BusinessRequirementWriteRepositoryInterface
{
    public function __construct(
        private PDO $pdo,
    ) {}

    public function create(BusinessRequirement $requirement): BusinessRequirement
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO core.business_requirements (code, description) VALUES (:code, :description)
             RETURNING id, code, description',
        );
        $stmt->execute(['code' => $requirement->code, 'description' => $requirement->description]);

        /** @var array{id: int, code: string, description: string} $row */
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return new BusinessRequirement((int) $row['id'], $row['code'], $row['description']);
    }

    public function update(BusinessRequirement $requirement): void
    {
        $this->pdo->prepare(
            'UPDATE core.business_requirements SET description = :description, updated_at = now() WHERE id = :id',
        )->execute(['description' => $requirement->description, 'id' => $requirement->id]);
    }
}
