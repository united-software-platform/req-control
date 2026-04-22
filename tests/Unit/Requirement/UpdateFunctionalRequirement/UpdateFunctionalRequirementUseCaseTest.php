<?php

declare(strict_types=1);

namespace Tests\Unit\Requirement\UpdateFunctionalRequirement;

use App\Requirement\Application\Dto\FunctionalRequirementDetail;
use App\Requirement\Application\Repository\FunctionalRequirementReadRepositoryInterface;
use App\Requirement\Application\UseCase\UpdateFunctionalRequirement\UpdateFunctionalRequirementInput;
use App\Requirement\Application\UseCase\UpdateFunctionalRequirement\UpdateFunctionalRequirementUseCase;
use App\Requirement\Domain\Model\FunctionalRequirement;
use App\Requirement\Domain\Repository\FunctionalRequirementWriteRepositoryInterface;
use PHPUnit\Framework\TestCase;

final class UpdateFunctionalRequirementUseCaseTest extends TestCase
{
    public function testExecuteLoadsCurrentStateAndUpdates(): void
    {
        $current = new FunctionalRequirementDetail(
            id: 3,
            code: 'APP-FT-2',
            description: 'Old functional description',
            projectId: 5,
            createdAt: '2026-04-01 00:00:00',
            updatedAt: '2026-04-01 00:00:00',
        );

        $reader = $this->createMock(FunctionalRequirementReadRepositoryInterface::class);
        $reader->expects($this->once())
            ->method('findById')
            ->with(3)
            ->willReturn($current);

        $repository = $this->createMock(FunctionalRequirementWriteRepositoryInterface::class);
        $repository->expects($this->once())
            ->method('update')
            ->with(new FunctionalRequirement(3, 'APP-FT-2', 'New functional description'));

        $useCase = new UpdateFunctionalRequirementUseCase($repository, $reader);
        $useCase->execute(new UpdateFunctionalRequirementInput(requirementId: 3, description: 'New functional description'));
    }
}
