<?php

declare(strict_types=1);

namespace App\Requirement\Infrastructure\Mcp\Tool;

use App\Requirement\Application\UseCase\CreateFunctionalRequirement\CreateFunctionalRequirementInput;
use App\Requirement\Application\UseCase\CreateFunctionalRequirement\CreateFunctionalRequirementUseCaseInterface;
use Mcp\Capability\Attribute\McpTool;
use Mcp\Capability\Attribute\Schema;
use Mcp\Schema\Content\TextContent;
use Mcp\Schema\Result\CallToolResult;

final readonly class CreateFunctionalRequirementTool
{
    public function __construct(
        private CreateFunctionalRequirementUseCaseInterface $useCase,
    ) {}

    #[McpTool(
        name: 'create_functional_requirement',
        description: 'Создаёт функциональное требование (ФТ) и привязывает его к проекту. Возвращает id и код FT-XXX.',
    )]
    public function __invoke(
        #[Schema(description: 'ID проекта', minimum: 1)]
        int $projectId,
        #[Schema(description: 'Описание функционального требования', minLength: 1)]
        string $description,
    ): CallToolResult {
        $output = $this->useCase->execute(new CreateFunctionalRequirementInput($projectId, $description));

        return CallToolResult::success(
            content: [new TextContent(['id' => $output->id, 'code' => $output->code])],
        );
    }
}
