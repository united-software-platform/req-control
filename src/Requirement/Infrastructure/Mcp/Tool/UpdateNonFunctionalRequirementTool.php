<?php

declare(strict_types=1);

namespace App\Requirement\Infrastructure\Mcp\Tool;

use App\Requirement\Application\UseCase\UpdateNonFunctionalRequirement\UpdateNonFunctionalRequirementInput;
use App\Requirement\Application\UseCase\UpdateNonFunctionalRequirement\UpdateNonFunctionalRequirementUseCaseInterface;
use App\Requirement\Domain\Model\NonFunctionalRequirementType;
use Mcp\Capability\Attribute\McpTool;
use Mcp\Capability\Attribute\Schema;
use Mcp\Schema\Content\TextContent;
use Mcp\Schema\Result\CallToolResult;

final readonly class UpdateNonFunctionalRequirementTool
{
    public function __construct(
        private UpdateNonFunctionalRequirementUseCaseInterface $useCase,
    ) {}

    #[McpTool(
        name: 'update_non_functional_requirement',
        description: 'Обновляет нефункциональное требование (НФТ). Передавай только изменяемые поля. Обновляет updated_at.',
    )]
    public function __invoke(
        #[Schema(description: 'ID нефункционального требования', minimum: 1)]
        int $requirementId,
        #[Schema(description: 'Новое описание нефункционального требования', minLength: 1)]
        ?string $description = null,
        #[Schema(description: 'Новый тип НФТ: performance, security, scalability, reliability', enum: ['performance', 'security', 'scalability', 'reliability'])]
        ?string $type = null,
        #[Schema(description: 'Новый критерий приёмки')]
        ?string $acceptanceCriteria = null,
    ): CallToolResult {
        $this->useCase->execute(new UpdateNonFunctionalRequirementInput(
            $requirementId,
            $description,
            null !== $type ? NonFunctionalRequirementType::from($type) : null,
            $acceptanceCriteria,
        ));

        return CallToolResult::success(
            content: [new TextContent(['updated' => true, 'requirement_id' => $requirementId])],
        );
    }
}
