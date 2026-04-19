<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\UpdateNonFunctionalRequirement;

use App\Requirement\Domain\Repository\NonFunctionalRequirementRepositoryInterface;

final readonly class UpdateNonFunctionalRequirementUseCase implements UpdateNonFunctionalRequirementUseCaseInterface
{
    public function __construct(
        private NonFunctionalRequirementRepositoryInterface $requirements,
    ) {}

    public function execute(UpdateNonFunctionalRequirementInput $input): void
    {
        $this->requirements->update(
            $input->requirementId,
            $input->description,
            $input->type,
            $input->acceptanceCriteria,
        );
    }
}
