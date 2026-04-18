<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\GetBusinessRequirement;

use App\Requirement\Domain\Repository\BusinessRequirementRepositoryInterface;

final readonly class GetBusinessRequirementUseCase implements GetBusinessRequirementUseCaseInterface
{
    public function __construct(
        private BusinessRequirementRepositoryInterface $requirements,
    ) {}

    public function execute(GetBusinessRequirementInput $input): GetBusinessRequirementOutput
    {
        return new GetBusinessRequirementOutput(
            $this->requirements->findById($input->requirementId),
        );
    }
}
