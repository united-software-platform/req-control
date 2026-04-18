--liquibase formatted sql

--changeset gaybovich:create-core-non_functional_requirements labels:create comment:Создание таблицы non_functional_requirements в схеме core
--preconditions onFail:MARK_RAN
--precondition-sql-check expectedResult:0 SELECT COUNT(*) FROM information_schema.tables WHERE table_schema='core' AND table_name='non_functional_requirements'

CREATE TABLE core.non_functional_requirements (
    id                  BIGSERIAL       PRIMARY KEY,
    code                VARCHAR(20)     NOT NULL UNIQUE,    -- пример: NFT-001
    type                VARCHAR(20)     NOT NULL,           -- performance, security, scalability, reliability
    description         TEXT            NOT NULL,
    acceptance_criteria TEXT,
    created_at          TIMESTAMPTZ     NOT NULL DEFAULT NOW(),
    updated_at          TIMESTAMPTZ     NOT NULL DEFAULT NOW()
);
