<?php

declare(strict_types=1);

namespace App\Requirement\Infrastructure\Mcp\Tool;

use App\Requirement\Application\UseCase\CreateBusinessRequirement\CreateBusinessRequirementInput;
use App\Requirement\Application\UseCase\CreateBusinessRequirement\CreateBusinessRequirementUseCaseInterface;
use Mcp\Capability\Attribute\McpTool;
use Mcp\Capability\Attribute\Schema;
use Mcp\Schema\Content\TextContent;
use Mcp\Schema\Result\CallToolResult;

final readonly class CreateBusinessRequirementTool
{
    public function __construct(
        private CreateBusinessRequirementUseCaseInterface $useCase,
    ) {}

    #[McpTool(
        name: 'create_business_requirement',
        description: 'Создаёт бизнес-требование (БТ) и привязывает его к проекту. Возвращает id и код BT-XXX.',
    )]
    public function __invoke(
        #[Schema(description: 'ID проекта', minimum: 1)]
        int $projectId,
        #[Schema(description: 'Описание бизнес-требования', minLength: 1)]
        string $description,
    ): CallToolResult {
        $output = $this->useCase->execute(new CreateBusinessRequirementInput($projectId, $description));

        return CallToolResult::success(
            content: [new TextContent(['id' => $output->id, 'code' => $output->code])],
        );
    }
}
