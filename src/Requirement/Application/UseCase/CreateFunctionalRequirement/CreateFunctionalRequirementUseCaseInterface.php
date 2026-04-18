<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\CreateFunctionalRequirement;

interface CreateFunctionalRequirementUseCaseInterface
{
    public function execute(CreateFunctionalRequirementInput $input): CreateFunctionalRequirementOutput;
}
