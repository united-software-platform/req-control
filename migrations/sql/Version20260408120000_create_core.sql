--liquibase formatted sql

--changeset auto:create-core labels:create comment:Создание схемы core
--preconditions onFail:MARK_RAN
--precondition-sql-check expectedResult:0 SELECT COUNT(*) FROM information_schema.schemata WHERE schema_name='core'

CREATE SCHEMA core;
