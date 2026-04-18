<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\UpdateBusinessRequirementDescription;

use App\Requirement\Domain\Repository\BusinessRequirementRepositoryInterface;

final readonly class UpdateBusinessRequirementDescriptionUseCase implements UpdateBusinessRequirementDescriptionUseCaseInterface
{
    public function __construct(
        private BusinessRequirementRepositoryInterface $requirements,
    ) {}

    public function execute(UpdateBusinessRequirementDescriptionInput $input): void
    {
        $this->requirements->updateDescription($input->requirementId, $input->description);
    }
}
