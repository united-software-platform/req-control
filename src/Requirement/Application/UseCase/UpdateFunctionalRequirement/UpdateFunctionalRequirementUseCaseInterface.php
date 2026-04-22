<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\UpdateFunctionalRequirement;

interface UpdateFunctionalRequirementUseCaseInterface
{
    public function execute(UpdateFunctionalRequirementInput $input): void;
}
