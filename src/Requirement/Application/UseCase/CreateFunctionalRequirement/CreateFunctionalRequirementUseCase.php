<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\CreateFunctionalRequirement;

use App\Requirement\Application\Repository\RequirementEntityLinkRepositoryInterface;
use App\Requirement\Domain\Model\FunctionalRequirement;
use App\Requirement\Domain\Model\RequirementEntityType;
use App\Requirement\Domain\Repository\FunctionalRequirementWriteRepositoryInterface;
use App\Shared\Application\Service\CodeGeneratorInterface;
use App\Task\Application\Repository\ProjectReadRepositoryInterface;

final readonly class CreateFunctionalRequirementUseCase implements CreateFunctionalRequirementUseCaseInterface
{
    public function __construct(
        private FunctionalRequirementWriteRepositoryInterface $requirements,
        private ProjectReadRepositoryInterface $projects,
        private RequirementEntityLinkRepositoryInterface $entityLinks,
        private CodeGeneratorInterface $codeGenerator,
    ) {}

    public function execute(CreateFunctionalRequirementInput $input): CreateFunctionalRequirementOutput
    {
        $project = $this->projects->findById($input->projectId);
        $code = $this->codeGenerator->generate($project->code, RequirementEntityType::FunctionalRequirement->value);

        $requirement = $this->requirements->create(new FunctionalRequirement(0, $code, $input->description));

        $this->entityLinks->link($project->id, $requirement->id, RequirementEntityType::FunctionalRequirement);

        return new CreateFunctionalRequirementOutput($requirement->id, $requirement->code);
    }
}
