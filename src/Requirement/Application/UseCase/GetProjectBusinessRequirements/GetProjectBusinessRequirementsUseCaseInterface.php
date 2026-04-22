<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\GetProjectBusinessRequirements;

interface GetProjectBusinessRequirementsUseCaseInterface
{
    public function execute(GetProjectBusinessRequirementsInput $input): GetProjectBusinessRequirementsOutput;
}
