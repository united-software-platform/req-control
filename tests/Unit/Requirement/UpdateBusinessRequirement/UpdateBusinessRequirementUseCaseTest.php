<?php

declare(strict_types=1);

namespace Tests\Unit\Requirement\UpdateBusinessRequirement;

use App\Requirement\Application\UseCase\UpdateBusinessRequirement\UpdateBusinessRequirementInput;
use App\Requirement\Application\UseCase\UpdateBusinessRequirement\UpdateBusinessRequirementUseCase;
use App\Requirement\Domain\Repository\BusinessRequirementWriteRepositoryInterface;
use PHPUnit\Framework\TestCase;

final class UpdateBusinessRequirementUseCaseTest extends TestCase
{
    public function testExecuteDelegatesToRepository(): void
    {
        $repository = $this->createMock(BusinessRequirementWriteRepositoryInterface::class);
        $repository->expects($this->once())
            ->method('update')
            ->with(5, 'Updated description');

        $useCase = new UpdateBusinessRequirementUseCase($repository);
        $useCase->execute(new UpdateBusinessRequirementInput(requirementId: 5, description: 'Updated description'));
    }
}
