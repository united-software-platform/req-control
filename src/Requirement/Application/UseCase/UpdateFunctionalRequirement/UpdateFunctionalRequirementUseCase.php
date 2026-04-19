<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\UpdateFunctionalRequirement;

use App\Requirement\Domain\Repository\FunctionalRequirementRepositoryInterface;

final readonly class UpdateFunctionalRequirementUseCase implements UpdateFunctionalRequirementUseCaseInterface
{
    public function __construct(
        private FunctionalRequirementRepositoryInterface $requirements,
    ) {}

    public function execute(UpdateFunctionalRequirementInput $input): void
    {
        $this->requirements->update($input->requirementId, $input->description);
    }
}
