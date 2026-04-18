<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\CreateBusinessRequirement;

use App\Requirement\Domain\Repository\BusinessRequirementRepositoryInterface;

final readonly class CreateBusinessRequirementUseCase implements CreateBusinessRequirementUseCaseInterface
{
    public function __construct(
        private BusinessRequirementRepositoryInterface $requirements,
    ) {}

    public function execute(CreateBusinessRequirementInput $input): CreateBusinessRequirementOutput
    {
        $requirement = $this->requirements->create($input->projectId, $input->description);

        return new CreateBusinessRequirementOutput($requirement->id, $requirement->code);
    }
}
