--liquibase formatted sql

--changeset gaybovich:Version20260415000001_create_schema_core
CREATE SCHEMA IF NOT EXISTS core;
--rollback DROP SCHEMA core;
