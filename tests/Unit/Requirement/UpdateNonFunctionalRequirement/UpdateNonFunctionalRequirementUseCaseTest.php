<?php

declare(strict_types=1);

namespace Tests\Unit\Requirement\UpdateNonFunctionalRequirement;

use App\Requirement\Application\Dto\NonFunctionalRequirementDetail;
use App\Requirement\Application\Repository\NonFunctionalRequirementReadRepositoryInterface;
use App\Requirement\Application\UseCase\UpdateNonFunctionalRequirement\UpdateNonFunctionalRequirementInput;
use App\Requirement\Application\UseCase\UpdateNonFunctionalRequirement\UpdateNonFunctionalRequirementUseCase;
use App\Requirement\Domain\Model\NonFunctionalRequirement;
use App\Requirement\Domain\Model\NonFunctionalRequirementType;
use App\Requirement\Domain\Repository\NonFunctionalRequirementWriteRepositoryInterface;
use PHPUnit\Framework\TestCase;

final class UpdateNonFunctionalRequirementUseCaseTest extends TestCase
{
    public function testExecuteMergesInputWithCurrentStateAndUpdates(): void
    {
        $current = new NonFunctionalRequirementDetail(
            id: 6,
            code: 'SVC-NFT-3',
            type: NonFunctionalRequirementType::Performance,
            description: 'Old description',
            acceptanceCriteria: 'Old criteria',
            createdAt: '2026-04-01 00:00:00',
            updatedAt: '2026-04-01 00:00:00',
        );

        $newType = NonFunctionalRequirementType::Scalability;

        $reader = $this->createMock(NonFunctionalRequirementReadRepositoryInterface::class);
        $reader->expects($this->once())
            ->method('findById')
            ->with(6)
            ->willReturn($current);

        $repository = $this->createMock(NonFunctionalRequirementWriteRepositoryInterface::class);
        $repository->expects($this->once())
            ->method('update')
            ->with(new NonFunctionalRequirement(6, 'SVC-NFT-3', $newType, 'Updated description', 'Must handle 10k RPS'));

        $useCase = new UpdateNonFunctionalRequirementUseCase($repository, $reader);
        $useCase->execute(new UpdateNonFunctionalRequirementInput(
            requirementId: 6,
            description: 'Updated description',
            type: $newType,
            acceptanceCriteria: 'Must handle 10k RPS',
        ));
    }

    public function testExecuteKeepsCurrentValuesWhenInputFieldsAreNull(): void
    {
        $current = new NonFunctionalRequirementDetail(
            id: 2,
            code: 'SVC-NFT-1',
            type: NonFunctionalRequirementType::Security,
            description: 'Current description',
            acceptanceCriteria: 'Current criteria',
            createdAt: '2026-04-01 00:00:00',
            updatedAt: '2026-04-01 00:00:00',
        );

        $reader = $this->createMock(NonFunctionalRequirementReadRepositoryInterface::class);
        $reader->expects($this->once())
            ->method('findById')
            ->with(2)
            ->willReturn($current);

        $repository = $this->createMock(NonFunctionalRequirementWriteRepositoryInterface::class);
        $repository->expects($this->once())
            ->method('update')
            ->with(new NonFunctionalRequirement(2, 'SVC-NFT-1', NonFunctionalRequirementType::Security, 'Current description', 'Current criteria'));

        $useCase = new UpdateNonFunctionalRequirementUseCase($repository, $reader);
        $useCase->execute(new UpdateNonFunctionalRequirementInput(requirementId: 2));
    }
}
