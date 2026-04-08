# Схема данных

## Таблицы

### `users`
Пользователи системы.

| Колонка      | Тип           | Описание                          |
|--------------|---------------|-----------------------------------|
| id           | BIGSERIAL PK  |                                   |
| external_id  | VARCHAR(255)  | ID из Google / внешней системы    |
| email        | VARCHAR(255)  | Уникальный email                  |
| name         | VARCHAR(255)  | Отображаемое имя                  |
| created_at   | TIMESTAMPTZ   |                                   |
| updated_at   | TIMESTAMPTZ   |                                   |

---

### `projects`
Проекты, группирующие задачи.

| Колонка     | Тип          | Описание        |
|-------------|--------------|-----------------|
| id          | BIGSERIAL PK |                 |
| name        | VARCHAR(255) |                 |
| description | TEXT         |                 |
| owner_id    | BIGINT FK    | → users(id)     |
| created_at  | TIMESTAMPTZ  |                 |
| updated_at  | TIMESTAMPTZ  |                 |

---

### `tasks`
Задачи с привязкой к проекту и исполнителю.

| Колонка          | Тип          | Описание                              |
|------------------|--------------|---------------------------------------|
| id               | BIGSERIAL PK |                                       |
| project_id       | BIGINT FK    | → projects(id)                        |
| assignee_id      | BIGINT FK    | → users(id)                           |
| title            | VARCHAR(500) |                                       |
| description      | TEXT         |                                       |
| status           | VARCHAR(50)  | TODO / IN_PROGRESS / REVIEW / DONE / CANCELLED |
| priority         | VARCHAR(20)  | LOW / MEDIUM / HIGH / CRITICAL        |
| estimated_hours  | NUMERIC(6,2) | Оценка в часах                        |
| sheet_row_id     | VARCHAR(100) | Идентификатор строки в Google Sheets  |
| created_at       | TIMESTAMPTZ  |                                       |
| updated_at       | TIMESTAMPTZ  |                                       |

---

### `time_entries`
Записи трекинга времени по задачам.

| Колонка    | Тип         | Описание                                 |
|------------|-------------|------------------------------------------|
| id         | BIGSERIAL PK|                                          |
| task_id    | BIGINT FK   | → tasks(id)                              |
| user_id    | BIGINT FK   | → users(id)                              |
| started_at | TIMESTAMPTZ | Начало работы                            |
| ended_at   | TIMESTAMPTZ | Конец работы (NULL = активный трекинг)   |
| duration_m | INTEGER     | Длительность в минутах (генерируемое)    |
| comment    | TEXT        | Комментарий к записи                     |
| created_at | TIMESTAMPTZ |                                          |

---

### `sync_log`
Лог синхронизации с Google Sheets.

| Колонка       | Тип         | Описание                              |
|---------------|-------------|---------------------------------------|
| id            | BIGSERIAL PK|                                       |
| entity_type   | VARCHAR(50) | task / time_entry                     |
| entity_id     | BIGINT      | ID сущности                           |
| direction     | VARCHAR(10) | INBOUND (из Sheets) / OUTBOUND (в Sheets) |
| status        | VARCHAR(20) | PENDING / SUCCESS / FAILED            |
| payload       | JSONB       | Исходный payload события              |
| error_message | TEXT        | Описание ошибки при FAILED            |
| processed_at  | TIMESTAMPTZ | Время обработки                       |
| created_at    | TIMESTAMPTZ |                                       |

## ER-диаграмма (текстовая)

```
users ──────────< projects
  │                   │
  │                   └──────< tasks >──── users (assignee)
  │                               │
  └───────────────────────< time_entries
                              
tasks ──< sync_log
time_entries ──< sync_log
```
