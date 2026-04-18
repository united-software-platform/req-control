<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\UpdateFunctionalRequirementDescription;

interface UpdateFunctionalRequirementDescriptionUseCaseInterface
{
    public function execute(UpdateFunctionalRequirementDescriptionInput $input): void;
}
