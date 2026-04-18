<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\GetNonFunctionalRequirement;

use App\Requirement\Domain\Repository\NonFunctionalRequirementRepositoryInterface;

final readonly class GetNonFunctionalRequirementUseCase implements GetNonFunctionalRequirementUseCaseInterface
{
    public function __construct(
        private NonFunctionalRequirementRepositoryInterface $requirements,
    ) {}

    public function execute(GetNonFunctionalRequirementInput $input): GetNonFunctionalRequirementOutput
    {
        return new GetNonFunctionalRequirementOutput(
            $this->requirements->findById($input->requirementId),
        );
    }
}
