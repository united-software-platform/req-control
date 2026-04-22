<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\UpdateNonFunctionalRequirement;

use App\Requirement\Application\Repository\NonFunctionalRequirementReadRepositoryInterface;
use App\Requirement\Domain\Model\NonFunctionalRequirement;
use App\Requirement\Domain\Repository\NonFunctionalRequirementWriteRepositoryInterface;

final readonly class UpdateNonFunctionalRequirementUseCase implements UpdateNonFunctionalRequirementUseCaseInterface
{
    public function __construct(
        private NonFunctionalRequirementWriteRepositoryInterface $requirements,
        private NonFunctionalRequirementReadRepositoryInterface $requirementReader,
    ) {}

    public function execute(UpdateNonFunctionalRequirementInput $input): void
    {
        $current = $this->requirementReader->findById($input->requirementId);

        $this->requirements->update(new NonFunctionalRequirement(
            $current->id,
            $current->code,
            $input->type ?? $current->type,
            $input->description ?? $current->description,
            $input->acceptanceCriteria ?? $current->acceptanceCriteria,
        ));
    }
}
