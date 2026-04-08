# Схема данных

> Текущая схема — начальная итерация. Отражает базовую инфраструктуру хранения.
> Полная схема под модель требований (requirements, traceability, deviations) проектируется отдельно.

## Схема `core`

### `core.types`
Справочник типов сущностей системы.

| Колонка    | Тип          | Описание          |
|------------|--------------|-------------------|
| id         | BIGSERIAL PK |                   |
| name       | TEXT         | Название типа     |
| created_at | TIMESTAMPTZ  |                   |
| updated_at | TIMESTAMPTZ  |                   |

Предустановленные значения: `Задача`, `Стори`, `Эпик`.

---

### `core.tasks`
Базовая иерархическая структура на основе Nested Sets.

| Колонка    | Тип           | Описание                              |
|------------|---------------|---------------------------------------|
| id         | BIGSERIAL PK  |                                       |
| title      | VARCHAR(200)  | Название                              |
| status     | SMALLINT      | Статус                                |
| type       | SMALLINT      | Тип (→ core.types)                    |
| parent_id  | SMALLINT      | ID родительской записи                |
| lft        | INTEGER       | Левая граница (Nested Sets)           |
| rgt        | INTEGER       | Правая граница (Nested Sets)          |
| depth      | INTEGER       | Глубина вложенности                   |
| created_at | TIMESTAMPTZ   |                                       |
| updated_at | TIMESTAMPTZ   |                                       |

**Индексы:**
- `idx_core_tasks_parent_id` — по `parent_id`
- `idx_core_tasks_lft_rgt` — по `(lft, rgt)`

## Иерархия

```
Эпик
 └── Стори
      └── Задача
```

Иерархия реализована через алгоритм Nested Sets: поля `lft`, `rgt`, `depth` позволяют
получить всё поддерево одним запросом без рекурсии.
