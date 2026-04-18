<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\UpdateBusinessRequirementDescription;

interface UpdateBusinessRequirementDescriptionUseCaseInterface
{
    public function execute(UpdateBusinessRequirementDescriptionInput $input): void;
}
