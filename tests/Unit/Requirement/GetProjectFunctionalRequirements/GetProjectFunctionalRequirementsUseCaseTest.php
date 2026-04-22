<?php

declare(strict_types=1);

namespace Tests\Unit\Requirement\GetProjectFunctionalRequirements;

use App\Requirement\Application\Repository\FunctionalRequirementReadRepositoryInterface;
use App\Requirement\Application\UseCase\GetProjectFunctionalRequirements\GetProjectFunctionalRequirementsInput;
use App\Requirement\Application\UseCase\GetProjectFunctionalRequirements\GetProjectFunctionalRequirementsUseCase;
use App\Requirement\Domain\Model\FunctionalRequirement;
use PHPUnit\Framework\TestCase;

final class GetProjectFunctionalRequirementsUseCaseTest extends TestCase
{
    public function testExecuteReturnsListOfRequirements(): void
    {
        $requirements = [
            new FunctionalRequirement(id: 1, code: 'APP-FT-1', description: 'FR 1'),
            new FunctionalRequirement(id: 2, code: 'APP-FT-2', description: 'FR 2'),
            new FunctionalRequirement(id: 3, code: 'APP-FT-3', description: 'FR 3'),
        ];

        $repository = $this->createMock(FunctionalRequirementReadRepositoryInterface::class);
        $repository->expects($this->once())
            ->method('listByProjectId')
            ->with(8)
            ->willReturn($requirements);

        $useCase = new GetProjectFunctionalRequirementsUseCase($repository);
        $output = $useCase->execute(new GetProjectFunctionalRequirementsInput(projectId: 8));

        $this->assertSame($requirements, $output->requirements);
    }

    public function testExecuteReturnsEmptyListWhenNoRequirementsExist(): void
    {
        $repository = $this->createMock(FunctionalRequirementReadRepositoryInterface::class);
        $repository->expects($this->once())
            ->method('listByProjectId')
            ->with(42)
            ->willReturn([]);

        $useCase = new GetProjectFunctionalRequirementsUseCase($repository);
        $output = $useCase->execute(new GetProjectFunctionalRequirementsInput(projectId: 42));

        $this->assertSame([], $output->requirements);
    }
}
