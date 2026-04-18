<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\UpdateFunctionalRequirementDescription;

use App\Requirement\Domain\Repository\FunctionalRequirementRepositoryInterface;

final readonly class UpdateFunctionalRequirementDescriptionUseCase implements UpdateFunctionalRequirementDescriptionUseCaseInterface
{
    public function __construct(
        private FunctionalRequirementRepositoryInterface $requirements,
    ) {}

    public function execute(UpdateFunctionalRequirementDescriptionInput $input): void
    {
        $this->requirements->updateDescription($input->requirementId, $input->description);
    }
}
