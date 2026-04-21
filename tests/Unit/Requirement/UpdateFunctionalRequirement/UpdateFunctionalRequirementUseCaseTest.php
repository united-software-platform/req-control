<?php

declare(strict_types=1);

namespace Tests\Unit\Requirement\UpdateFunctionalRequirement;

use App\Requirement\Application\UseCase\UpdateFunctionalRequirement\UpdateFunctionalRequirementInput;
use App\Requirement\Application\UseCase\UpdateFunctionalRequirement\UpdateFunctionalRequirementUseCase;
use App\Requirement\Domain\Repository\FunctionalRequirementWriteRepositoryInterface;
use PHPUnit\Framework\TestCase;

final class UpdateFunctionalRequirementUseCaseTest extends TestCase
{
    public function testExecuteDelegatesToRepository(): void
    {
        $repository = $this->createMock(FunctionalRequirementWriteRepositoryInterface::class);
        $repository->expects($this->once())
            ->method('update')
            ->with(3, 'New functional description');

        $useCase = new UpdateFunctionalRequirementUseCase($repository);
        $useCase->execute(new UpdateFunctionalRequirementInput(requirementId: 3, description: 'New functional description'));
    }
}
