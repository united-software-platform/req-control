<?php

declare(strict_types=1);

namespace App\Task\Application\UseCase\GetEpicStories;

interface GetEpicStoriesUseCaseInterface
{
    public function execute(GetEpicStoriesInput $input): GetEpicStoriesOutput;
}
