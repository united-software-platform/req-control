<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\GetBusinessRequirement;

use App\Requirement\Application\Repository\BusinessRequirementReadRepositoryInterface;
use App\Requirement\Application\Repository\FunctionalRequirementReadRepositoryInterface;

final readonly class GetBusinessRequirementUseCase implements GetBusinessRequirementUseCaseInterface
{
    public function __construct(
        private BusinessRequirementReadRepositoryInterface $businessRequirements,
        private FunctionalRequirementReadRepositoryInterface $functionalRequirements,
    ) {}

    public function execute(GetBusinessRequirementInput $input): GetBusinessRequirementOutput
    {
        $requirement = $this->businessRequirements->findById($input->requirementId);
        $functionalRequirements = $this->functionalRequirements->listByProjectId($requirement->projectId);

        return new GetBusinessRequirementOutput($requirement, $functionalRequirements);
    }
}
