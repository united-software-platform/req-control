<?php

declare(strict_types=1);

namespace App\Requirement\Domain\Model;

enum NonFunctionalRequirementType: string
{
    case Performance = 'performance';
    case Security = 'security';
    case Scalability = 'scalability';
    case Reliability = 'reliability';
}
