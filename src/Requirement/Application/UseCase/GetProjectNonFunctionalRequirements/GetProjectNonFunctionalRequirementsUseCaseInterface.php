<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\GetProjectNonFunctionalRequirements;

interface GetProjectNonFunctionalRequirementsUseCaseInterface
{
    public function execute(GetProjectNonFunctionalRequirementsInput $input): GetProjectNonFunctionalRequirementsOutput;
}
