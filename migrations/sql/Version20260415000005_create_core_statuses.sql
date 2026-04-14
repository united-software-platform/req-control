--liquibase formatted sql

--changeset gaybovich:Version20260415000005_create_core_statuses
CREATE TABLE core.statuses (
    id         SMALLINT        PRIMARY KEY,
    name       VARCHAR(100)    NOT NULL,
    created_at TIMESTAMPTZ     NOT NULL DEFAULT NOW(),
    updated_at TIMESTAMPTZ     NOT NULL DEFAULT NOW()
);
--rollback DROP TABLE core.statuses;
