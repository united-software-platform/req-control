<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\CreateNonFunctionalRequirement;

use App\Requirement\Domain\Repository\NonFunctionalRequirementRepositoryInterface;

final readonly class CreateNonFunctionalRequirementUseCase implements CreateNonFunctionalRequirementUseCaseInterface
{
    public function __construct(
        private NonFunctionalRequirementRepositoryInterface $requirements,
    ) {}

    public function execute(CreateNonFunctionalRequirementInput $input): CreateNonFunctionalRequirementOutput
    {
        $requirement = $this->requirements->create(
            $input->projectId,
            $input->type,
            $input->description,
            $input->acceptanceCriteria,
        );

        return new CreateNonFunctionalRequirementOutput($requirement->id, $requirement->code);
    }
}
