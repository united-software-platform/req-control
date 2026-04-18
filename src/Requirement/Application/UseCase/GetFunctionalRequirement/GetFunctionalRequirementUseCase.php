<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\GetFunctionalRequirement;

use App\Requirement\Domain\Repository\FunctionalRequirementRepositoryInterface;

final readonly class GetFunctionalRequirementUseCase implements GetFunctionalRequirementUseCaseInterface
{
    public function __construct(
        private FunctionalRequirementRepositoryInterface $requirements,
    ) {}

    public function execute(GetFunctionalRequirementInput $input): GetFunctionalRequirementOutput
    {
        return new GetFunctionalRequirementOutput(
            $this->requirements->findById($input->requirementId),
        );
    }
}
