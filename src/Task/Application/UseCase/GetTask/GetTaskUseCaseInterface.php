<?php

declare(strict_types=1);

namespace App\Task\Application\UseCase\GetTask;

interface GetTaskUseCaseInterface
{
    public function execute(GetTaskInput $input): GetTaskOutput;
}
