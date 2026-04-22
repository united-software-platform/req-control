<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\UpdateFunctionalRequirement;

use App\Requirement\Application\Repository\FunctionalRequirementReadRepositoryInterface;
use App\Requirement\Domain\Model\FunctionalRequirement;
use App\Requirement\Domain\Repository\FunctionalRequirementWriteRepositoryInterface;

final readonly class UpdateFunctionalRequirementUseCase implements UpdateFunctionalRequirementUseCaseInterface
{
    public function __construct(
        private FunctionalRequirementWriteRepositoryInterface $requirements,
        private FunctionalRequirementReadRepositoryInterface $requirementReader,
    ) {}

    public function execute(UpdateFunctionalRequirementInput $input): void
    {
        $current = $this->requirementReader->findById($input->requirementId);

        $this->requirements->update(new FunctionalRequirement(
            $current->id,
            $current->code,
            $input->description,
        ));
    }
}
