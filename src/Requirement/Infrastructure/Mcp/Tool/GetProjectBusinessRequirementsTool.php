<?php

declare(strict_types=1);

namespace App\Requirement\Infrastructure\Mcp\Tool;

use App\Requirement\Application\UseCase\GetProjectBusinessRequirements\GetProjectBusinessRequirementsInput;
use App\Requirement\Application\UseCase\GetProjectBusinessRequirements\GetProjectBusinessRequirementsUseCaseInterface;
use App\Requirement\Domain\Model\BusinessRequirement;
use Mcp\Capability\Attribute\McpTool;
use Mcp\Capability\Attribute\Schema;
use Mcp\Schema\Content\TextContent;
use Mcp\Schema\Result\CallToolResult;

final readonly class GetProjectBusinessRequirementsTool
{
    public function __construct(
        private GetProjectBusinessRequirementsUseCaseInterface $useCase,
    ) {}

    #[McpTool(
        name: 'get_project_business_requirements',
        description: 'Возвращает плоский список бизнес-требований (БТ) проекта: id, код BT-XXX, краткое описание.',
    )]
    public function __invoke(
        #[Schema(description: 'ID проекта', minimum: 1)]
        int $projectId,
    ): CallToolResult {
        $output = $this->useCase->execute(new GetProjectBusinessRequirementsInput($projectId));

        return CallToolResult::success(
            content: [new TextContent(array_map(
                static fn (BusinessRequirement $r) => ['id' => $r->id, 'code' => $r->code, 'description' => $r->description],
                $output->requirements,
            ))],
            meta: ['count' => count($output->requirements)],
        );
    }
}
