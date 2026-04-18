<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\GetProjectFunctionalRequirements;

interface GetProjectFunctionalRequirementsUseCaseInterface
{
    public function execute(GetProjectFunctionalRequirementsInput $input): GetProjectFunctionalRequirementsOutput;
}
