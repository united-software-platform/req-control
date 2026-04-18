<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\CreateFunctionalRequirement;

use App\Requirement\Domain\Repository\FunctionalRequirementRepositoryInterface;

final readonly class CreateFunctionalRequirementUseCase implements CreateFunctionalRequirementUseCaseInterface
{
    public function __construct(
        private FunctionalRequirementRepositoryInterface $requirements,
    ) {}

    public function execute(CreateFunctionalRequirementInput $input): CreateFunctionalRequirementOutput
    {
        $requirement = $this->requirements->create($input->projectId, $input->description);

        return new CreateFunctionalRequirementOutput($requirement->id, $requirement->code);
    }
}
