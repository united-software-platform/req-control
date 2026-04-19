<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\UpdateBusinessRequirement;

use App\Requirement\Domain\Repository\BusinessRequirementRepositoryInterface;

final readonly class UpdateBusinessRequirementUseCase implements UpdateBusinessRequirementUseCaseInterface
{
    public function __construct(
        private BusinessRequirementRepositoryInterface $requirements,
    ) {}

    public function execute(UpdateBusinessRequirementInput $input): void
    {
        $this->requirements->update($input->requirementId, $input->description);
    }
}
