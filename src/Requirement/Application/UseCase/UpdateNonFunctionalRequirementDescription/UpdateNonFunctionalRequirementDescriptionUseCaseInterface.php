<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\UpdateNonFunctionalRequirementDescription;

interface UpdateNonFunctionalRequirementDescriptionUseCaseInterface
{
    public function execute(UpdateNonFunctionalRequirementDescriptionInput $input): void;
}
