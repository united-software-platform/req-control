<?php

declare(strict_types=1);

namespace App\Requirement\Infrastructure\Mcp\Tool;

use App\Requirement\Application\UseCase\UpdateBusinessRequirementDescription\UpdateBusinessRequirementDescriptionInput;
use App\Requirement\Application\UseCase\UpdateBusinessRequirementDescription\UpdateBusinessRequirementDescriptionUseCaseInterface;
use Mcp\Capability\Attribute\McpTool;
use Mcp\Capability\Attribute\Schema;
use Mcp\Schema\Content\TextContent;
use Mcp\Schema\Result\CallToolResult;

final readonly class UpdateBusinessRequirementDescriptionTool
{
    public function __construct(
        private UpdateBusinessRequirementDescriptionUseCaseInterface $useCase,
    ) {}

    #[McpTool(
        name: 'update_business_requirement_description',
        description: 'Обновляет описание бизнес-требования (БТ). Обновляет поле description и updated_at.',
    )]
    public function __invoke(
        #[Schema(description: 'ID бизнес-требования', minimum: 1)]
        int $requirementId,
        #[Schema(description: 'Новое описание бизнес-требования', minLength: 1)]
        string $description,
    ): CallToolResult {
        $this->useCase->execute(new UpdateBusinessRequirementDescriptionInput($requirementId, $description));

        return CallToolResult::success(
            content: [new TextContent(['updated' => true, 'requirement_id' => $requirementId])],
        );
    }
}
