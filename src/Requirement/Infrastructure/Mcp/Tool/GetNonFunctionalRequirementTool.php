<?php

declare(strict_types=1);

namespace App\Requirement\Infrastructure\Mcp\Tool;

use App\Requirement\Application\UseCase\GetNonFunctionalRequirement\GetNonFunctionalRequirementInput;
use App\Requirement\Application\UseCase\GetNonFunctionalRequirement\GetNonFunctionalRequirementUseCaseInterface;
use Mcp\Capability\Attribute\McpTool;
use Mcp\Capability\Attribute\Schema;
use Mcp\Schema\Content\TextContent;
use Mcp\Schema\Result\CallToolResult;

final readonly class GetNonFunctionalRequirementTool
{
    public function __construct(
        private GetNonFunctionalRequirementUseCaseInterface $useCase,
    ) {}

    #[McpTool(
        name: 'get_non_functional_requirement',
        description: 'Возвращает детали нефункционального требования: код NFT-XXX, тип, полное описание, критерий приёмки, created_at, updated_at.',
    )]
    public function __invoke(
        #[Schema(description: 'ID нефункционального требования', minimum: 1)]
        int $requirementId,
    ): CallToolResult {
        $output = $this->useCase->execute(new GetNonFunctionalRequirementInput($requirementId));
        $r = $output->requirement;

        return CallToolResult::success(
            content: [new TextContent([
                'id' => $r->id,
                'code' => $r->code,
                'type' => $r->type->value,
                'description' => $r->description,
                'acceptance_criteria' => $r->acceptanceCriteria,
                'created_at' => $r->createdAt,
                'updated_at' => $r->updatedAt,
            ])],
        );
    }
}
