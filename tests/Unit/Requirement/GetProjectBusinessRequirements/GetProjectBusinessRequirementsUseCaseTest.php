<?php

declare(strict_types=1);

namespace Tests\Unit\Requirement\GetProjectBusinessRequirements;

use App\Requirement\Application\UseCase\GetProjectBusinessRequirements\GetProjectBusinessRequirementsInput;
use App\Requirement\Application\UseCase\GetProjectBusinessRequirements\GetProjectBusinessRequirementsUseCase;
use App\Requirement\Domain\Model\BusinessRequirement;
use App\Requirement\Domain\Repository\BusinessRequirementReadRepositoryInterface;
use PHPUnit\Framework\TestCase;

final class GetProjectBusinessRequirementsUseCaseTest extends TestCase
{
    public function testExecuteReturnsListOfRequirements(): void
    {
        $requirements = [
            new BusinessRequirement(id: 1, code: 'PROJ-BT-1', description: 'BR 1'),
            new BusinessRequirement(id: 2, code: 'PROJ-BT-2', description: 'BR 2'),
        ];

        $repository = $this->createMock(BusinessRequirementReadRepositoryInterface::class);
        $repository->expects($this->once())
            ->method('listByProjectId')
            ->with(15)
            ->willReturn($requirements);

        $useCase = new GetProjectBusinessRequirementsUseCase($repository);
        $output = $useCase->execute(new GetProjectBusinessRequirementsInput(projectId: 15));

        $this->assertSame($requirements, $output->requirements);
    }

    public function testExecuteReturnsEmptyListWhenNoRequirementsExist(): void
    {
        $repository = $this->createMock(BusinessRequirementReadRepositoryInterface::class);
        $repository->expects($this->once())
            ->method('listByProjectId')
            ->with(99)
            ->willReturn([]);

        $useCase = new GetProjectBusinessRequirementsUseCase($repository);
        $output = $useCase->execute(new GetProjectBusinessRequirementsInput(projectId: 99));

        $this->assertSame([], $output->requirements);
    }
}
