<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\UpdateNonFunctionalRequirement;

interface UpdateNonFunctionalRequirementUseCaseInterface
{
    public function execute(UpdateNonFunctionalRequirementInput $input): void;
}
