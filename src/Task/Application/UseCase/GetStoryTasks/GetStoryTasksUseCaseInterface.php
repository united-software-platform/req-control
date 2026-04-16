<?php

declare(strict_types=1);

namespace App\Task\Application\UseCase\GetStoryTasks;

interface GetStoryTasksUseCaseInterface
{
    public function execute(GetStoryTasksInput $input): GetStoryTasksOutput;
}
