# Task Tracker — Система тайм-трекинга задач

## Описание

Система для учёта времени по задачам с двусторонней синхронизацией через Google Sheets.
Позволяет фиксировать затраченное время, управлять задачами и получать актуальные данные
в Google Sheets через webhook-интеграцию на базе RabbitMQ.

## Стек

| Компонент     | Технология              | Назначение                                      |
|---------------|-------------------------|-------------------------------------------------|
| База данных   | PostgreSQL 16           | Основное хранилище задач, трекингов, пользователей |
| Миграции      | Liquibase               | Версионирование схемы БД                        |
| Брокер        | RabbitMQ 3.13           | Синхронизация данных, обработка хуков Google Sheets |
| Окружение     | Docker / Docker Compose | Локальная разработка                            |

## Архитектура

```
Google Sheets
    │
    │  webhook (hook-events)
    ▼
[RabbitMQ]──────────────────────────────────┐
    │                                        │
    │  consume                               │  publish
    ▼                                        │
[Consumer Service]                    [Publisher Service]
    │                                        ▲
    │  read/write                            │ changes
    ▼                                        │
[PostgreSQL] ───────────────────────────────┘
```

## Структура проекта

```
task-trecker/
├── docker/
│   ├── docker-compose.yml       # Локальное окружение
│   ├── docker-compose.override.yml
│   └── .env.example
├── migrations/
│   ├── changelog/
│   │   └── db.changelog-master.xml
│   └── sql/
│       └── 001_init_schema.sql
├── docs/
│   └── schema.md                # Описание схемы данных
└── README.md
```

## Быстрый старт

```bash
# Скопировать переменные окружения
cp docker/.env.example docker/.env

# Поднять окружение
docker compose -f docker/docker-compose.yml up -d

# Применить миграции
docker compose -f docker/docker-compose.yml run --rm liquibase update
```

## Очереди RabbitMQ

| Exchange              | Queue                        | Назначение                          |
|-----------------------|------------------------------|-------------------------------------|
| `sheets.hooks`        | `sheets.task.created`        | Создание задачи из Google Sheets    |
| `sheets.hooks`        | `sheets.task.updated`        | Обновление задачи из Google Sheets  |
| `tracker.events`      | `tracker.sync.sheets`        | Публикация изменений в Google Sheets |

## Схема данных (кратко)

- `users` — пользователи системы
- `projects` — проекты
- `tasks` — задачи (привязка к проекту, исполнителю)
- `time_entries` — записи трекинга времени
- `sync_log` — лог синхронизации с Google Sheets
