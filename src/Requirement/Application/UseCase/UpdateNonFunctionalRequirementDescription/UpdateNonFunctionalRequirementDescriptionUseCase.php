<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\UpdateNonFunctionalRequirementDescription;

use App\Requirement\Domain\Repository\NonFunctionalRequirementRepositoryInterface;

final readonly class UpdateNonFunctionalRequirementDescriptionUseCase implements UpdateNonFunctionalRequirementDescriptionUseCaseInterface
{
    public function __construct(
        private NonFunctionalRequirementRepositoryInterface $requirements,
    ) {}

    public function execute(UpdateNonFunctionalRequirementDescriptionInput $input): void
    {
        $this->requirements->updateDescription($input->requirementId, $input->description);
    }
}
