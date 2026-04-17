<?php

declare(strict_types=1);

namespace App\Task\Application\UseCase\UpdateTask;

interface UpdateTaskUseCaseInterface
{
    public function execute(UpdateTaskInput $input): void;
}
