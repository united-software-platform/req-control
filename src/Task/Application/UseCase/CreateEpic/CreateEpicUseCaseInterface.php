<?php

declare(strict_types=1);

namespace App\Task\Application\UseCase\CreateEpic;

interface CreateEpicUseCaseInterface
{
    public function execute(CreateEpicInput $input): CreateEpicOutput;
}
