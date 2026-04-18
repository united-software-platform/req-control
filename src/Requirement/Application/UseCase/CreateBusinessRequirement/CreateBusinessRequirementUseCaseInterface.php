<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\CreateBusinessRequirement;

interface CreateBusinessRequirementUseCaseInterface
{
    public function execute(CreateBusinessRequirementInput $input): CreateBusinessRequirementOutput;
}
