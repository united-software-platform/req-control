--liquibase formatted sql

--changeset gaybovich:Version20260415000002_create_core_epics
CREATE TABLE core.epics (
    id          BIGSERIAL       PRIMARY KEY,
    title       VARCHAR(200)    NOT NULL,
    description TEXT,
    created_at  TIMESTAMPTZ     NOT NULL DEFAULT NOW(),
    updated_at  TIMESTAMPTZ     NOT NULL DEFAULT NOW()
);
--rollback DROP TABLE core.epics;
