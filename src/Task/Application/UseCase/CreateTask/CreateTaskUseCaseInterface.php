<?php

declare(strict_types=1);

namespace App\Task\Application\UseCase\CreateTask;

interface CreateTaskUseCaseInterface
{
    public function execute(CreateTaskInput $input): CreateTaskOutput;
}
