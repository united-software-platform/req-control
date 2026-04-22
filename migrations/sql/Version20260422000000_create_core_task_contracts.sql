--liquibase formatted sql

--changeset auto:create-core-task_contracts labels:create comment:Создание таблицы task_contracts в схеме core
--preconditions onFail:MARK_RAN
--precondition-sql-check expectedResult:0 SELECT COUNT(*) FROM information_schema.tables WHERE table_schema='core' AND table_name='task_contracts'

CREATE TABLE core.task_contracts (
    id          BIGSERIAL     PRIMARY KEY,
    task_id     BIGINT        NOT NULL UNIQUE,
    tables      TEXT,                              -- TOON-encoded, nullable (багфикс может не иметь контракта)
    created_at  TIMESTAMPTZ   NOT NULL DEFAULT NOW(),
    updated_at  TIMESTAMPTZ   NOT NULL DEFAULT NOW(),

    CONSTRAINT fk_task_contracts_task_id
        FOREIGN KEY (task_id)
            REFERENCES core.tasks(id)
            ON DELETE CASCADE
            ON UPDATE CASCADE
);
