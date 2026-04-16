<?php

declare(strict_types=1);

namespace App\Task\Application\UseCase\GetEpics;

interface GetEpicsUseCaseInterface
{
    public function execute(): GetEpicsOutput;
}
