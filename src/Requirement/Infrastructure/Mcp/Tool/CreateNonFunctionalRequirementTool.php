<?php

declare(strict_types=1);

namespace App\Requirement\Infrastructure\Mcp\Tool;

use App\Requirement\Application\UseCase\CreateNonFunctionalRequirement\CreateNonFunctionalRequirementInput;
use App\Requirement\Application\UseCase\CreateNonFunctionalRequirement\CreateNonFunctionalRequirementUseCaseInterface;
use App\Requirement\Domain\Model\NonFunctionalRequirementType;
use Mcp\Capability\Attribute\McpTool;
use Mcp\Capability\Attribute\Schema;
use Mcp\Schema\Content\TextContent;
use Mcp\Schema\Result\CallToolResult;

final readonly class CreateNonFunctionalRequirementTool
{
    public function __construct(
        private CreateNonFunctionalRequirementUseCaseInterface $useCase,
    ) {}

    #[McpTool(
        name: 'create_non_functional_requirement',
        description: 'Создаёт нефункциональное требование (НФТ) и привязывает его к проекту. Возвращает id и код NFT-XXX.',
    )]
    public function __invoke(
        #[Schema(description: 'ID проекта', minimum: 1)]
        int $projectId,
        #[Schema(description: 'Тип НФТ: performance, security, scalability, reliability')]
        string $type,
        #[Schema(description: 'Описание нефункционального требования', minLength: 1)]
        string $description,
        #[Schema(description: 'Критерий приёмки (необязательно)')]
        ?string $acceptanceCriteria = null,
    ): CallToolResult {
        $output = $this->useCase->execute(new CreateNonFunctionalRequirementInput(
            $projectId,
            NonFunctionalRequirementType::from($type),
            $description,
            $acceptanceCriteria,
        ));

        return CallToolResult::success(
            content: [new TextContent(['id' => $output->id, 'code' => $output->code])],
        );
    }
}
