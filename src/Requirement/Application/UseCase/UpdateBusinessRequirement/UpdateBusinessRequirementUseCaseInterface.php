<?php

declare(strict_types=1);

namespace App\Requirement\Application\UseCase\UpdateBusinessRequirement;

interface UpdateBusinessRequirementUseCaseInterface
{
    public function execute(UpdateBusinessRequirementInput $input): void;
}
