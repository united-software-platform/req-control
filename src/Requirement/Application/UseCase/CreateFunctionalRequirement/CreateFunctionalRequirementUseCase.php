<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\CreateFunctionalRequirement;

use App\Requirement\Domain\Model\RequirementEntityType;
use App\Requirement\Domain\Repository\FunctionalRequirementWriteRepositoryInterface;
use App\Shared\Application\Service\CodeGeneratorInterface;
use App\Task\Domain\Repository\ProjectRepositoryInterface;

final readonly class CreateFunctionalRequirementUseCase implements CreateFunctionalRequirementUseCaseInterface
{
    public function __construct(
        private FunctionalRequirementWriteRepositoryInterface $requirements,
        private ProjectRepositoryInterface $projects,
        private CodeGeneratorInterface $codeGenerator,
    ) {}

    public function execute(CreateFunctionalRequirementInput $input): CreateFunctionalRequirementOutput
    {
        $project = $this->projects->findById($input->projectId);
        $code = $this->codeGenerator->generate($project->code, RequirementEntityType::FunctionalRequirement->value);

        $requirement = $this->requirements->create($project->id, $code, $input->description);

        return new CreateFunctionalRequirementOutput($requirement->id, $requirement->code);
    }
}
