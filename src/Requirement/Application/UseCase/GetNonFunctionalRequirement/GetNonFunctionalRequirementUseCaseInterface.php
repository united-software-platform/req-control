<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\GetNonFunctionalRequirement;

interface GetNonFunctionalRequirementUseCaseInterface
{
    public function execute(GetNonFunctionalRequirementInput $input): GetNonFunctionalRequirementOutput;
}
