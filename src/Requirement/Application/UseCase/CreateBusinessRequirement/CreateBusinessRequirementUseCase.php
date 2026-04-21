<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\CreateBusinessRequirement;

use App\Requirement\Domain\Model\RequirementEntityType;
use App\Requirement\Domain\Repository\BusinessRequirementWriteRepositoryInterface;
use App\Shared\Application\Service\CodeGeneratorInterface;
use App\Task\Domain\Repository\ProjectRepositoryInterface;

final readonly class CreateBusinessRequirementUseCase implements CreateBusinessRequirementUseCaseInterface
{
    public function __construct(
        private BusinessRequirementWriteRepositoryInterface $requirements,
        private ProjectRepositoryInterface $projects,
        private CodeGeneratorInterface $codeGenerator,
    ) {}

    public function execute(CreateBusinessRequirementInput $input): CreateBusinessRequirementOutput
    {
        $project = $this->projects->findById($input->projectId);
        $code = $this->codeGenerator->generate($project->code, RequirementEntityType::BusinessRequirement->value);

        $requirement = $this->requirements->create($project->id, $code, $input->description);

        return new CreateBusinessRequirementOutput($requirement->id, $requirement->code);
    }
}
