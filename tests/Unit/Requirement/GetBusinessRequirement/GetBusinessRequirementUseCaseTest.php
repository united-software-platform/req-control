<?php

declare(strict_types=1);

namespace Tests\Unit\Requirement\GetBusinessRequirement;

use App\Requirement\Application\UseCase\GetBusinessRequirement\GetBusinessRequirementInput;
use App\Requirement\Application\UseCase\GetBusinessRequirement\GetBusinessRequirementUseCase;
use App\Requirement\Domain\Model\BusinessRequirementDetail;
use App\Requirement\Domain\Model\FunctionalRequirement;
use App\Requirement\Domain\Repository\BusinessRequirementReadRepositoryInterface;
use App\Requirement\Domain\Repository\FunctionalRequirementReadRepositoryInterface;
use PHPUnit\Framework\TestCase;

final class GetBusinessRequirementUseCaseTest extends TestCase
{
    public function testExecuteReturnsBrWithRelatedFunctionalRequirements(): void
    {
        $detail = new BusinessRequirementDetail(
            id: 1,
            code: 'PROJ-BT-1',
            description: 'Some business requirement',
            projectId: 10,
            createdAt: '2026-04-01 00:00:00',
            updatedAt: '2026-04-01 00:00:00',
        );

        $functionalRequirements = [
            new FunctionalRequirement(id: 2, code: 'PROJ-FT-1', description: 'FR 1'),
            new FunctionalRequirement(id: 3, code: 'PROJ-FT-2', description: 'FR 2'),
        ];

        $businessRequirements = $this->createMock(BusinessRequirementReadRepositoryInterface::class);
        $businessRequirements->expects($this->once())
            ->method('findById')
            ->with(1)
            ->willReturn($detail);

        $functionalRepo = $this->createMock(FunctionalRequirementReadRepositoryInterface::class);
        $functionalRepo->expects($this->once())
            ->method('listByProjectId')
            ->with(10)
            ->willReturn($functionalRequirements);

        $useCase = new GetBusinessRequirementUseCase($businessRequirements, $functionalRepo);
        $output = $useCase->execute(new GetBusinessRequirementInput(requirementId: 1));

        $this->assertSame($detail, $output->requirement);
        $this->assertSame($functionalRequirements, $output->functionalRequirements);
    }

    public function testExecuteReturnsEmptyFunctionalRequirementsWhenNoneExist(): void
    {
        $detail = new BusinessRequirementDetail(
            id: 5,
            code: 'PROJ-BT-2',
            description: 'Another BR',
            projectId: 20,
            createdAt: '2026-04-01 00:00:00',
            updatedAt: '2026-04-01 00:00:00',
        );

        $businessRequirements = $this->createStub(BusinessRequirementReadRepositoryInterface::class);
        $businessRequirements->method('findById')->willReturn($detail);

        $functionalRepo = $this->createStub(FunctionalRequirementReadRepositoryInterface::class);
        $functionalRepo->method('listByProjectId')->willReturn([]);

        $useCase = new GetBusinessRequirementUseCase($businessRequirements, $functionalRepo);
        $output = $useCase->execute(new GetBusinessRequirementInput(requirementId: 5));

        $this->assertSame([], $output->functionalRequirements);
    }
}
