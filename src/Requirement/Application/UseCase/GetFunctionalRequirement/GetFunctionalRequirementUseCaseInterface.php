<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\GetFunctionalRequirement;

interface GetFunctionalRequirementUseCaseInterface
{
    public function execute(GetFunctionalRequirementInput $input): GetFunctionalRequirementOutput;
}
