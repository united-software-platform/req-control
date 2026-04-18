<?php

declare(strict_types=1);

namespace App\Shared\Application\Service;

interface CodeGeneratorInterface
{
    public function generate(string $projectCode, string $entityType): string;
}
