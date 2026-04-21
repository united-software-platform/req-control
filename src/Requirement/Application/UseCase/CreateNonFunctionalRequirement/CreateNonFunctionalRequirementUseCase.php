<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\CreateNonFunctionalRequirement;

use App\Requirement\Domain\Model\RequirementEntityType;
use App\Requirement\Domain\Repository\NonFunctionalRequirementWriteRepositoryInterface;
use App\Shared\Application\Service\CodeGeneratorInterface;
use App\Task\Domain\Repository\ProjectRepositoryInterface;

final readonly class CreateNonFunctionalRequirementUseCase implements CreateNonFunctionalRequirementUseCaseInterface
{
    public function __construct(
        private NonFunctionalRequirementWriteRepositoryInterface $requirements,
        private ProjectRepositoryInterface $projects,
        private CodeGeneratorInterface $codeGenerator,
    ) {}

    public function execute(CreateNonFunctionalRequirementInput $input): CreateNonFunctionalRequirementOutput
    {
        $project = $this->projects->findById($input->projectId);
        $code = $this->codeGenerator->generate($project->code, RequirementEntityType::NonFunctionalRequirement->value);

        $requirement = $this->requirements->create($project->id, $code, $input->type, $input->description, $input->acceptanceCriteria);

        return new CreateNonFunctionalRequirementOutput($requirement->id, $requirement->code);
    }
}
