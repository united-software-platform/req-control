<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\GetFunctionalRequirement;

use App\Requirement\Application\Repository\FunctionalRequirementReadRepositoryInterface;
use App\Task\Application\Repository\TaskReadRepositoryInterface;

final readonly class GetFunctionalRequirementUseCase implements GetFunctionalRequirementUseCaseInterface
{
    public function __construct(
        private FunctionalRequirementReadRepositoryInterface $requirements,
        private TaskReadRepositoryInterface $tasks,
    ) {}

    public function execute(GetFunctionalRequirementInput $input): GetFunctionalRequirementOutput
    {
        $requirement = $this->requirements->findById($input->requirementId);
        $tasks = $this->tasks->listByProjectId($requirement->projectId);

        return new GetFunctionalRequirementOutput($requirement, $tasks);
    }
}
