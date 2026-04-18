<?php

declare(strict_types=1);

namespace App\Requirement\Infrastructure\Mcp\Tool;

use App\Requirement\Application\UseCase\GetProjectFunctionalRequirements\GetProjectFunctionalRequirementsInput;
use App\Requirement\Application\UseCase\GetProjectFunctionalRequirements\GetProjectFunctionalRequirementsUseCaseInterface;
use App\Requirement\Domain\Model\FunctionalRequirement;
use Mcp\Capability\Attribute\McpTool;
use Mcp\Capability\Attribute\Schema;
use Mcp\Schema\Content\TextContent;
use Mcp\Schema\Result\CallToolResult;

final readonly class GetProjectFunctionalRequirementsTool
{
    public function __construct(
        private GetProjectFunctionalRequirementsUseCaseInterface $useCase,
    ) {}

    #[McpTool(
        name: 'get_project_functional_requirements',
        description: 'Возвращает плоский список функциональных требований (ФТ) проекта: id, код FT-XXX, краткое описание.',
    )]
    public function __invoke(
        #[Schema(description: 'ID проекта', minimum: 1)]
        int $projectId,
    ): CallToolResult {
        $output = $this->useCase->execute(new GetProjectFunctionalRequirementsInput($projectId));

        return CallToolResult::success(
            content: [new TextContent(array_map(
                static fn (FunctionalRequirement $r) => ['id' => $r->id, 'code' => $r->code, 'description' => $r->description],
                $output->requirements,
            ))],
            meta: ['count' => count($output->requirements)],
        );
    }
}
