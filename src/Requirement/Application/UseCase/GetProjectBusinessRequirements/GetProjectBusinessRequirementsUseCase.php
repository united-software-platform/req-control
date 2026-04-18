<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\GetProjectBusinessRequirements;

use App\Requirement\Domain\Repository\BusinessRequirementRepositoryInterface;

final readonly class GetProjectBusinessRequirementsUseCase implements GetProjectBusinessRequirementsUseCaseInterface
{
    public function __construct(
        private BusinessRequirementRepositoryInterface $requirements,
    ) {}

    public function execute(GetProjectBusinessRequirementsInput $input): GetProjectBusinessRequirementsOutput
    {
        return new GetProjectBusinessRequirementsOutput(
            $this->requirements->listByProjectId($input->projectId),
        );
    }
}
