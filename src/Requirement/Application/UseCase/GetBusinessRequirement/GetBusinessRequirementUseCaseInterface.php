<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\GetBusinessRequirement;

interface GetBusinessRequirementUseCaseInterface
{
    public function execute(GetBusinessRequirementInput $input): GetBusinessRequirementOutput;
}
