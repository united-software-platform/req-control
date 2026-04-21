<?php

declare(strict_types=1);

namespace Tests\Unit\Requirement\UpdateNonFunctionalRequirement;

use App\Requirement\Application\UseCase\UpdateNonFunctionalRequirement\UpdateNonFunctionalRequirementInput;
use App\Requirement\Application\UseCase\UpdateNonFunctionalRequirement\UpdateNonFunctionalRequirementUseCase;
use App\Requirement\Domain\Model\NonFunctionalRequirementType;
use App\Requirement\Domain\Repository\NonFunctionalRequirementWriteRepositoryInterface;
use PHPUnit\Framework\TestCase;

final class UpdateNonFunctionalRequirementUseCaseTest extends TestCase
{
    public function testExecuteDelegatesToRepositoryWithAllFields(): void
    {
        $type = NonFunctionalRequirementType::Scalability;

        $repository = $this->createMock(NonFunctionalRequirementWriteRepositoryInterface::class);
        $repository->expects($this->once())
            ->method('update')
            ->with(6, 'Updated description', $type, 'Must handle 10k RPS');

        $useCase = new UpdateNonFunctionalRequirementUseCase($repository);
        $useCase->execute(new UpdateNonFunctionalRequirementInput(
            requirementId: 6,
            description: 'Updated description',
            type: $type,
            acceptanceCriteria: 'Must handle 10k RPS',
        ));
    }

    public function testExecuteDelegatesToRepositoryWithNullFields(): void
    {
        $repository = $this->createMock(NonFunctionalRequirementWriteRepositoryInterface::class);
        $repository->expects($this->once())
            ->method('update')
            ->with(2, null, null, null);

        $useCase = new UpdateNonFunctionalRequirementUseCase($repository);
        $useCase->execute(new UpdateNonFunctionalRequirementInput(requirementId: 2));
    }
}
