<?php

declare(strict_types=1);

namespace App\Task\Infrastructure\Mcp\Tool;

use App\Task\Application\UseCase\CreateEpic\CreateEpicInput;
use App\Task\Application\UseCase\CreateEpic\CreateEpicUseCaseInterface;
use Mcp\Capability\Attribute\McpTool;
use Mcp\Capability\Attribute\Schema;
use Mcp\Schema\Content\TextContent;
use Mcp\Schema\Result\CallToolResult;

final readonly class CreateEpicTool
{
    public function __construct(
        private CreateEpicUseCaseInterface $useCase,
    ) {}

    #[McpTool(
        name: 'create_epic',
        description: 'Создаёт новый эпик. Возвращает id и title созданного эпика.',
    )]
    public function __invoke(
        #[Schema(description: 'ID проекта', minimum: 1)]
        int $projectId,
        #[Schema(description: 'Название эпика', minLength: 1, maxLength: 200)]
        string $title,
        #[Schema(description: 'Описание эпика (необязательно)')]
        ?string $description = null,
    ): CallToolResult {
        $output = $this->useCase->execute(new CreateEpicInput($projectId, $title, $description));

        return CallToolResult::success(
            content: [new TextContent(['id' => $output->id, 'code' => $output->code, 'title' => $output->title])],
        );
    }
}
