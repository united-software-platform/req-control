<?php

declare(strict_types=1);

namespace Tests\Unit\Requirement\CreateBusinessRequirement;

use App\Requirement\Application\Repository\RequirementEntityLinkRepositoryInterface;
use App\Requirement\Application\UseCase\CreateBusinessRequirement\CreateBusinessRequirementInput;
use App\Requirement\Application\UseCase\CreateBusinessRequirement\CreateBusinessRequirementUseCase;
use App\Requirement\Domain\Model\BusinessRequirement;
use App\Requirement\Domain\Model\RequirementEntityType;
use App\Requirement\Domain\Repository\BusinessRequirementWriteRepositoryInterface;
use App\Shared\Application\Service\CodeGeneratorInterface;
use App\Task\Domain\Model\Project;
use App\Task\Application\Repository\ProjectReadRepositoryInterface;
use PHPUnit\Framework\TestCase;

final class CreateBusinessRequirementUseCaseTest extends TestCase
{
    public function testExecuteCreatesRequirementAndReturnsOutput(): void
    {
        $project = new Project(id: 10, code: 'PROJ');
        $generatedCode = 'PROJ-BT-1';
        $description = 'Business requirement description';

        $projects = $this->createMock(ProjectReadRepositoryInterface::class);
        $projects->expects($this->once())
            ->method('findById')
            ->with(10)
            ->willReturn($project);

        $codeGenerator = $this->createMock(CodeGeneratorInterface::class);
        $codeGenerator->expects($this->once())
            ->method('generate')
            ->with('PROJ', RequirementEntityType::BusinessRequirement->value)
            ->willReturn($generatedCode);

        $requirement = new BusinessRequirement(id: 42, code: $generatedCode, description: $description);

        $requirements = $this->createMock(BusinessRequirementWriteRepositoryInterface::class);
        $requirements->expects($this->once())
            ->method('create')
            ->with(new BusinessRequirement(0, $generatedCode, $description))
            ->willReturn($requirement);

        $entityLinks = $this->createMock(RequirementEntityLinkRepositoryInterface::class);
        $entityLinks->expects($this->once())
            ->method('link')
            ->with(10, 42, RequirementEntityType::BusinessRequirement);

        $useCase = new CreateBusinessRequirementUseCase($requirements, $projects, $entityLinks, $codeGenerator);
        $output = $useCase->execute(new CreateBusinessRequirementInput(projectId: 10, description: $description));

        $this->assertSame(42, $output->id);
        $this->assertSame($generatedCode, $output->code);
    }
}
