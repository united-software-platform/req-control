<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\UpdateBusinessRequirement;

use App\Requirement\Application\Repository\BusinessRequirementReadRepositoryInterface;
use App\Requirement\Domain\Model\BusinessRequirement;
use App\Requirement\Domain\Repository\BusinessRequirementWriteRepositoryInterface;

final readonly class UpdateBusinessRequirementUseCase implements UpdateBusinessRequirementUseCaseInterface
{
    public function __construct(
        private BusinessRequirementWriteRepositoryInterface $requirements,
        private BusinessRequirementReadRepositoryInterface $requirementReader,
    ) {}

    public function execute(UpdateBusinessRequirementInput $input): void
    {
        $current = $this->requirementReader->findById($input->requirementId);

        $this->requirements->update(new BusinessRequirement(
            $current->id,
            $current->code,
            $input->description,
        ));
    }
}
