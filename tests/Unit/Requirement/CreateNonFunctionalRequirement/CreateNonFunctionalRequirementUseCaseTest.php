<?php

declare(strict_types=1);

namespace Tests\Unit\Requirement\CreateNonFunctionalRequirement;

use App\Requirement\Application\Repository\RequirementEntityLinkRepositoryInterface;
use App\Requirement\Application\UseCase\CreateNonFunctionalRequirement\CreateNonFunctionalRequirementInput;
use App\Requirement\Application\UseCase\CreateNonFunctionalRequirement\CreateNonFunctionalRequirementUseCase;
use App\Requirement\Domain\Model\NonFunctionalRequirement;
use App\Requirement\Domain\Model\NonFunctionalRequirementType;
use App\Requirement\Domain\Model\RequirementEntityType;
use App\Requirement\Domain\Repository\NonFunctionalRequirementWriteRepositoryInterface;
use App\Shared\Application\Service\CodeGeneratorInterface;
use App\Task\Domain\Model\Project;
use App\Task\Application\Repository\ProjectReadRepositoryInterface;
use PHPUnit\Framework\TestCase;

final class CreateNonFunctionalRequirementUseCaseTest extends TestCase
{
    public function testExecuteCreatesRequirementAndReturnsOutput(): void
    {
        $project = new Project(id: 3, code: 'SVC');
        $generatedCode = 'SVC-NFT-1';
        $type = NonFunctionalRequirementType::Performance;
        $description = 'Response time under 200ms';
        $acceptanceCriteria = 'p99 latency < 200ms';

        $projects = $this->createMock(ProjectReadRepositoryInterface::class);
        $projects->expects($this->once())
            ->method('findById')
            ->with(3)
            ->willReturn($project);

        $codeGenerator = $this->createMock(CodeGeneratorInterface::class);
        $codeGenerator->expects($this->once())
            ->method('generate')
            ->with('SVC', RequirementEntityType::NonFunctionalRequirement->value)
            ->willReturn($generatedCode);

        $requirement = new NonFunctionalRequirement(id: 11, code: $generatedCode, type: $type, description: $description, acceptanceCriteria: $acceptanceCriteria);

        $requirements = $this->createMock(NonFunctionalRequirementWriteRepositoryInterface::class);
        $requirements->expects($this->once())
            ->method('create')
            ->with(new NonFunctionalRequirement(0, $generatedCode, $type, $description, $acceptanceCriteria))
            ->willReturn($requirement);

        $entityLinks = $this->createMock(RequirementEntityLinkRepositoryInterface::class);
        $entityLinks->expects($this->once())
            ->method('link')
            ->with(3, 11, RequirementEntityType::NonFunctionalRequirement);

        $useCase = new CreateNonFunctionalRequirementUseCase($requirements, $projects, $entityLinks, $codeGenerator);
        $output = $useCase->execute(new CreateNonFunctionalRequirementInput(
            projectId: 3,
            type: $type,
            description: $description,
            acceptanceCriteria: $acceptanceCriteria,
        ));

        $this->assertSame(11, $output->id);
        $this->assertSame($generatedCode, $output->code);
    }

    public function testExecutePassesNullAcceptanceCriteria(): void
    {
        $project = new Project(id: 1, code: 'X');
        $type = NonFunctionalRequirementType::Security;

        $projects = $this->createStub(ProjectReadRepositoryInterface::class);
        $projects->method('findById')->willReturn($project);

        $codeGenerator = $this->createStub(CodeGeneratorInterface::class);
        $codeGenerator->method('generate')->willReturn('X-NFT-1');

        $requirement = new NonFunctionalRequirement(id: 1, code: 'X-NFT-1', type: $type, description: 'desc');

        $requirements = $this->createMock(NonFunctionalRequirementWriteRepositoryInterface::class);
        $requirements->expects($this->once())
            ->method('create')
            ->with(new NonFunctionalRequirement(0, 'X-NFT-1', $type, 'desc', null))
            ->willReturn($requirement);

        $entityLinks = $this->createStub(RequirementEntityLinkRepositoryInterface::class);

        $useCase = new CreateNonFunctionalRequirementUseCase($requirements, $projects, $entityLinks, $codeGenerator);
        $useCase->execute(new CreateNonFunctionalRequirementInput(
            projectId: 1,
            type: $type,
            description: 'desc',
            acceptanceCriteria: null,
        ));
    }
}
