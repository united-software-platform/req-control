<?php

declare(strict_types=1);

namespace Tests\Unit\Requirement\CreateFunctionalRequirement;

use App\Requirement\Application\Repository\RequirementEntityLinkRepositoryInterface;
use App\Requirement\Application\UseCase\CreateFunctionalRequirement\CreateFunctionalRequirementInput;
use App\Requirement\Application\UseCase\CreateFunctionalRequirement\CreateFunctionalRequirementUseCase;
use App\Requirement\Domain\Model\FunctionalRequirement;
use App\Requirement\Domain\Model\RequirementEntityType;
use App\Requirement\Domain\Repository\FunctionalRequirementWriteRepositoryInterface;
use App\Shared\Application\Service\CodeGeneratorInterface;
use App\Task\Domain\Model\Project;
use App\Task\Application\Repository\ProjectReadRepositoryInterface;
use PHPUnit\Framework\TestCase;

final class CreateFunctionalRequirementUseCaseTest extends TestCase
{
    public function testExecuteCreatesRequirementAndReturnsOutput(): void
    {
        $project = new Project(id: 5, code: 'APP');
        $generatedCode = 'APP-FT-3';
        $description = 'Functional requirement description';

        $projects = $this->createMock(ProjectReadRepositoryInterface::class);
        $projects->expects($this->once())
            ->method('findById')
            ->with(5)
            ->willReturn($project);

        $codeGenerator = $this->createMock(CodeGeneratorInterface::class);
        $codeGenerator->expects($this->once())
            ->method('generate')
            ->with('APP', RequirementEntityType::FunctionalRequirement->value)
            ->willReturn($generatedCode);

        $requirement = new FunctionalRequirement(id: 7, code: $generatedCode, description: $description);

        $requirements = $this->createMock(FunctionalRequirementWriteRepositoryInterface::class);
        $requirements->expects($this->once())
            ->method('create')
            ->with(new FunctionalRequirement(0, $generatedCode, $description))
            ->willReturn($requirement);

        $entityLinks = $this->createMock(RequirementEntityLinkRepositoryInterface::class);
        $entityLinks->expects($this->once())
            ->method('link')
            ->with(5, 7, RequirementEntityType::FunctionalRequirement);

        $useCase = new CreateFunctionalRequirementUseCase($requirements, $projects, $entityLinks, $codeGenerator);
        $output = $useCase->execute(new CreateFunctionalRequirementInput(projectId: 5, description: $description));

        $this->assertSame(7, $output->id);
        $this->assertSame($generatedCode, $output->code);
    }
}
