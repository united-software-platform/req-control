<?php

declare(strict_types=1);

namespace App\Requirement\Infrastructure\Mcp\Tool;

use App\Requirement\Application\UseCase\GetProjectNonFunctionalRequirements\GetProjectNonFunctionalRequirementsInput;
use App\Requirement\Application\UseCase\GetProjectNonFunctionalRequirements\GetProjectNonFunctionalRequirementsUseCaseInterface;
use App\Requirement\Domain\Model\NonFunctionalRequirement;
use Mcp\Capability\Attribute\McpTool;
use Mcp\Capability\Attribute\Schema;
use Mcp\Schema\Content\TextContent;
use Mcp\Schema\Result\CallToolResult;

final readonly class GetProjectNonFunctionalRequirementsTool
{
    public function __construct(
        private GetProjectNonFunctionalRequirementsUseCaseInterface $useCase,
    ) {}

    #[McpTool(
        name: 'get_project_non_functional_requirements',
        description: 'Возвращает список нефункциональных требований (НФТ) проекта: id, код NFT-XXX, тип (performance/security/scalability/reliability), краткое описание.',
    )]
    public function __invoke(
        #[Schema(description: 'ID проекта', minimum: 1)]
        int $projectId,
    ): CallToolResult {
        $output = $this->useCase->execute(new GetProjectNonFunctionalRequirementsInput($projectId));

        return CallToolResult::success(
            content: [new TextContent(array_map(
                static fn (NonFunctionalRequirement $r) => [
                    'id' => $r->id,
                    'code' => $r->code,
                    'type' => $r->type->value,
                    'description' => $r->description,
                ],
                $output->requirements,
            ))],
            meta: ['count' => count($output->requirements)],
        );
    }
}
