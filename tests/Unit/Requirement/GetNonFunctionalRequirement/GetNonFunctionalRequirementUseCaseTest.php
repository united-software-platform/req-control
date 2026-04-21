<?php

declare(strict_types=1);

namespace Tests\Unit\Requirement\GetNonFunctionalRequirement;

use App\Requirement\Application\UseCase\GetNonFunctionalRequirement\GetNonFunctionalRequirementInput;
use App\Requirement\Application\UseCase\GetNonFunctionalRequirement\GetNonFunctionalRequirementUseCase;
use App\Requirement\Domain\Model\NonFunctionalRequirementDetail;
use App\Requirement\Domain\Model\NonFunctionalRequirementType;
use App\Requirement\Domain\Repository\NonFunctionalRequirementReadRepositoryInterface;
use PHPUnit\Framework\TestCase;

final class GetNonFunctionalRequirementUseCaseTest extends TestCase
{
    public function testExecuteReturnsNfrDetail(): void
    {
        $detail = new NonFunctionalRequirementDetail(
            id: 4,
            code: 'SVC-NFT-2',
            type: NonFunctionalRequirementType::Security,
            description: 'All endpoints require auth',
            acceptanceCriteria: 'Returns 401 for unauthenticated requests',
            createdAt: '2026-04-01 00:00:00',
            updatedAt: '2026-04-01 00:00:00',
        );

        $requirements = $this->createMock(NonFunctionalRequirementReadRepositoryInterface::class);
        $requirements->expects($this->once())
            ->method('findById')
            ->with(4)
            ->willReturn($detail);

        $useCase = new GetNonFunctionalRequirementUseCase($requirements);
        $output = $useCase->execute(new GetNonFunctionalRequirementInput(requirementId: 4));

        $this->assertSame($detail, $output->requirement);
    }

    public function testExecuteReturnsNfrDetailWithNullAcceptanceCriteria(): void
    {
        $detail = new NonFunctionalRequirementDetail(
            id: 8,
            code: 'SVC-NFT-3',
            type: NonFunctionalRequirementType::Reliability,
            description: '99.9% uptime',
            acceptanceCriteria: null,
            createdAt: '2026-04-01 00:00:00',
            updatedAt: '2026-04-01 00:00:00',
        );

        $requirements = $this->createStub(NonFunctionalRequirementReadRepositoryInterface::class);
        $requirements->method('findById')->willReturn($detail);

        $useCase = new GetNonFunctionalRequirementUseCase($requirements);
        $output = $useCase->execute(new GetNonFunctionalRequirementInput(requirementId: 8));

        $this->assertNull($output->requirement->acceptanceCriteria);
    }
}
