--liquibase formatted sql

--changeset gaybovich:Version20260415000004_create_core_tasks
CREATE TABLE core.tasks (
    id          BIGSERIAL       PRIMARY KEY,
    story_id    BIGINT          NOT NULL,
    title       VARCHAR(200)    NOT NULL,
    description TEXT,
    status      SMALLINT        NOT NULL,                          -- числовой код статуса; интерпретируется приложением
    readiness   SMALLINT        NOT NULL DEFAULT 0
                                CHECK (readiness >= 0 AND readiness <= 100),  -- готовность, %
    created_at  TIMESTAMPTZ     NOT NULL DEFAULT NOW(),
    updated_at  TIMESTAMPTZ     NOT NULL DEFAULT NOW(),

    CONSTRAINT fk_tasks_story_id
        FOREIGN KEY (story_id)
            REFERENCES core.stories(id)
            ON DELETE RESTRICT
            ON UPDATE CASCADE
);

CREATE INDEX idx_core_tasks_story_id ON core.tasks (story_id);
--rollback DROP TABLE core.tasks;
