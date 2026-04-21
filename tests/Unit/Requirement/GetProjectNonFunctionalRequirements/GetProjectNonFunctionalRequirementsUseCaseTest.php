<?php

declare(strict_types=1);

namespace Tests\Unit\Requirement\GetProjectNonFunctionalRequirements;

use App\Requirement\Application\UseCase\GetProjectNonFunctionalRequirements\GetProjectNonFunctionalRequirementsInput;
use App\Requirement\Application\UseCase\GetProjectNonFunctionalRequirements\GetProjectNonFunctionalRequirementsUseCase;
use App\Requirement\Domain\Model\NonFunctionalRequirement;
use App\Requirement\Domain\Model\NonFunctionalRequirementType;
use App\Requirement\Domain\Repository\NonFunctionalRequirementReadRepositoryInterface;
use PHPUnit\Framework\TestCase;

final class GetProjectNonFunctionalRequirementsUseCaseTest extends TestCase
{
    public function testExecuteReturnsListOfRequirements(): void
    {
        $requirements = [
            new NonFunctionalRequirement(id: 1, code: 'SVC-NFT-1', type: NonFunctionalRequirementType::Performance, description: 'NFR 1'),
            new NonFunctionalRequirement(id: 2, code: 'SVC-NFT-2', type: NonFunctionalRequirementType::Security, description: 'NFR 2'),
        ];

        $repository = $this->createMock(NonFunctionalRequirementReadRepositoryInterface::class);
        $repository->expects($this->once())
            ->method('listByProjectId')
            ->with(12)
            ->willReturn($requirements);

        $useCase = new GetProjectNonFunctionalRequirementsUseCase($repository);
        $output = $useCase->execute(new GetProjectNonFunctionalRequirementsInput(projectId: 12));

        $this->assertSame($requirements, $output->requirements);
    }

    public function testExecuteReturnsEmptyListWhenNoRequirementsExist(): void
    {
        $repository = $this->createMock(NonFunctionalRequirementReadRepositoryInterface::class);
        $repository->expects($this->once())
            ->method('listByProjectId')
            ->with(7)
            ->willReturn([]);

        $useCase = new GetProjectNonFunctionalRequirementsUseCase($repository);
        $output = $useCase->execute(new GetProjectNonFunctionalRequirementsInput(projectId: 7));

        $this->assertSame([], $output->requirements);
    }
}
