<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\GetProjectFunctionalRequirements;

use App\Requirement\Domain\Repository\FunctionalRequirementRepositoryInterface;

final readonly class GetProjectFunctionalRequirementsUseCase implements GetProjectFunctionalRequirementsUseCaseInterface
{
    public function __construct(
        private FunctionalRequirementRepositoryInterface $requirements,
    ) {}

    public function execute(GetProjectFunctionalRequirementsInput $input): GetProjectFunctionalRequirementsOutput
    {
        return new GetProjectFunctionalRequirementsOutput(
            $this->requirements->listByProjectId($input->projectId),
        );
    }
}
