<?php

declare(strict_types=1);

namespace Tests\Unit\Requirement\GetFunctionalRequirement;

use App\Requirement\Application\UseCase\GetFunctionalRequirement\GetFunctionalRequirementInput;
use App\Requirement\Application\UseCase\GetFunctionalRequirement\GetFunctionalRequirementUseCase;
use App\Requirement\Domain\Model\FunctionalRequirementDetail;
use App\Requirement\Domain\Repository\FunctionalRequirementReadRepositoryInterface;
use App\Task\Application\Dto\TaskSummary;
use App\Task\Domain\Repository\TaskRepositoryInterface;
use PHPUnit\Framework\TestCase;

final class GetFunctionalRequirementUseCaseTest extends TestCase
{
    public function testExecuteReturnsFrWithRelatedTasks(): void
    {
        $detail = new FunctionalRequirementDetail(
            id: 3,
            code: 'APP-FT-1',
            description: 'Functional requirement',
            projectId: 7,
            createdAt: '2026-04-01 00:00:00',
            updatedAt: '2026-04-01 00:00:00',
        );

        $tasks = [
            new TaskSummary(id: 1, title: 'Task A', status: 1, readiness: 0),
            new TaskSummary(id: 2, title: 'Task B', status: 2, readiness: 50),
        ];

        $requirements = $this->createMock(FunctionalRequirementReadRepositoryInterface::class);
        $requirements->expects($this->once())
            ->method('findById')
            ->with(3)
            ->willReturn($detail);

        $taskRepository = $this->createMock(TaskRepositoryInterface::class);
        $taskRepository->expects($this->once())
            ->method('listByProjectId')
            ->with(7)
            ->willReturn($tasks);

        $useCase = new GetFunctionalRequirementUseCase($requirements, $taskRepository);
        $output = $useCase->execute(new GetFunctionalRequirementInput(requirementId: 3));

        $this->assertSame($detail, $output->requirement);
        $this->assertSame($tasks, $output->tasks);
    }

    public function testExecuteReturnsEmptyTasksWhenNoneExist(): void
    {
        $detail = new FunctionalRequirementDetail(
            id: 9,
            code: 'APP-FT-5',
            description: 'FR without tasks',
            projectId: 2,
            createdAt: '2026-04-01 00:00:00',
            updatedAt: '2026-04-01 00:00:00',
        );

        $requirements = $this->createStub(FunctionalRequirementReadRepositoryInterface::class);
        $requirements->method('findById')->willReturn($detail);

        $taskRepository = $this->createStub(TaskRepositoryInterface::class);
        $taskRepository->method('listByProjectId')->willReturn([]);

        $useCase = new GetFunctionalRequirementUseCase($requirements, $taskRepository);
        $output = $useCase->execute(new GetFunctionalRequirementInput(requirementId: 9));

        $this->assertSame([], $output->tasks);
    }
}
