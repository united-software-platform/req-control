<?php

declare(strict_types=1);

namespace Tests\Unit\Requirement\UpdateBusinessRequirement;

use App\Requirement\Application\Dto\BusinessRequirementDetail;
use App\Requirement\Application\Repository\BusinessRequirementReadRepositoryInterface;
use App\Requirement\Application\UseCase\UpdateBusinessRequirement\UpdateBusinessRequirementInput;
use App\Requirement\Application\UseCase\UpdateBusinessRequirement\UpdateBusinessRequirementUseCase;
use App\Requirement\Domain\Model\BusinessRequirement;
use App\Requirement\Domain\Repository\BusinessRequirementWriteRepositoryInterface;
use PHPUnit\Framework\TestCase;

final class UpdateBusinessRequirementUseCaseTest extends TestCase
{
    public function testExecuteLoadsCurrentStateAndUpdates(): void
    {
        $current = new BusinessRequirementDetail(
            id: 5,
            code: 'PROJ-BT-1',
            description: 'Old description',
            projectId: 10,
            createdAt: '2026-04-01 00:00:00',
            updatedAt: '2026-04-01 00:00:00',
        );

        $reader = $this->createMock(BusinessRequirementReadRepositoryInterface::class);
        $reader->expects($this->once())
            ->method('findById')
            ->with(5)
            ->willReturn($current);

        $repository = $this->createMock(BusinessRequirementWriteRepositoryInterface::class);
        $repository->expects($this->once())
            ->method('update')
            ->with(new BusinessRequirement(5, 'PROJ-BT-1', 'Updated description'));

        $useCase = new UpdateBusinessRequirementUseCase($repository, $reader);
        $useCase->execute(new UpdateBusinessRequirementInput(requirementId: 5, description: 'Updated description'));
    }
}
