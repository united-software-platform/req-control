<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\CreateNonFunctionalRequirement;

interface CreateNonFunctionalRequirementUseCaseInterface
{
    public function execute(CreateNonFunctionalRequirementInput $input): CreateNonFunctionalRequirementOutput;
}
