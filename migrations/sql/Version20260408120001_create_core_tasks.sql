--liquibase formatted sql

--changeset auto:create-core-tasks labels:create comment:Создание таблицы tasks в схеме core
--preconditions onFail:MARK_RAN
--precondition-sql-check expectedResult:0 SELECT COUNT(*) FROM information_schema.tables WHERE table_schema='core' AND table_name='tasks'

CREATE TABLE core.tasks (
    id          BIGSERIAL       PRIMARY KEY,
    title       VARCHAR(200)    NOT NULL,
    status      SMALLINT        NOT NULL,
    parent_id   SMALLINT,
    lft         INTEGER         NOT NULL DEFAULT 0,
    rgt         INTEGER         NOT NULL DEFAULT 0,
    depth       INTEGER         NOT NULL DEFAULT 0,
    created_at  TIMESTAMPTZ     NOT NULL DEFAULT NOW(),
    updated_at  TIMESTAMPTZ     NOT NULL DEFAULT NOW()
);

CREATE INDEX idx_core_tasks_parent_id ON core.tasks(parent_id);
CREATE INDEX idx_core_tasks_lft_rgt   ON core.tasks(lft, rgt);
