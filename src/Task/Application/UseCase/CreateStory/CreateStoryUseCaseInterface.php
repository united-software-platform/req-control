<?php

declare(strict_types=1);

namespace App\Task\Application\UseCase\CreateStory;

interface CreateStoryUseCaseInterface
{
    public function execute(CreateStoryInput $input): CreateStoryOutput;
}
