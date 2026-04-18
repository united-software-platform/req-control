<?php

declare(strict_types=1);

namespace App\Requirement\Infrastructure\Mcp\Tool;

use App\Requirement\Application\UseCase\UpdateNonFunctionalRequirementDescription\UpdateNonFunctionalRequirementDescriptionInput;
use App\Requirement\Application\UseCase\UpdateNonFunctionalRequirementDescription\UpdateNonFunctionalRequirementDescriptionUseCaseInterface;
use Mcp\Capability\Attribute\McpTool;
use Mcp\Capability\Attribute\Schema;
use Mcp\Schema\Content\TextContent;
use Mcp\Schema\Result\CallToolResult;

final readonly class UpdateNonFunctionalRequirementDescriptionTool
{
    public function __construct(
        private UpdateNonFunctionalRequirementDescriptionUseCaseInterface $useCase,
    ) {}

    #[McpTool(
        name: 'update_non_functional_requirement_description',
        description: 'Обновляет описание нефункционального требования (НФТ). Обновляет поле description и updated_at.',
    )]
    public function __invoke(
        #[Schema(description: 'ID нефункционального требования', minimum: 1)]
        int $requirementId,
        #[Schema(description: 'Новое описание нефункционального требования', minLength: 1)]
        string $description,
    ): CallToolResult {
        $this->useCase->execute(new UpdateNonFunctionalRequirementDescriptionInput($requirementId, $description));

        return CallToolResult::success(
            content: [new TextContent(['updated' => true, 'requirement_id' => $requirementId])],
        );
    }
}
