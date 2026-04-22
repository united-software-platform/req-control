<?php

declare(strict_types=1);

namespace App\Requirement\Infrastructure\Mcp\Tool;

use App\Requirement\Application\UseCase\UpdateBusinessRequirement\UpdateBusinessRequirementInput;
use App\Requirement\Application\UseCase\UpdateBusinessRequirement\UpdateBusinessRequirementUseCaseInterface;
use Mcp\Capability\Attribute\McpTool;
use Mcp\Capability\Attribute\Schema;
use Mcp\Schema\Content\TextContent;
use Mcp\Schema\Result\CallToolResult;

final readonly class UpdateBusinessRequirementTool
{
    public function __construct(
        private UpdateBusinessRequirementUseCaseInterface $useCase,
    ) {}

    #[McpTool(
        name: 'update_business_requirement',
        description: 'Обновляет бизнес-требование (БТ). Обновляет поле description и updated_at.',
    )]
    public function __invoke(
        #[Schema(description: 'ID бизнес-требования', minimum: 1)]
        int $requirementId,
        #[Schema(description: 'Новое описание бизнес-требования', minLength: 1)]
        string $description,
    ): CallToolResult {
        $this->useCase->execute(new UpdateBusinessRequirementInput($requirementId, $description));

        return CallToolResult::success(
            content: [new TextContent(['updated' => true, 'requirement_id' => $requirementId])],
        );
    }
}
