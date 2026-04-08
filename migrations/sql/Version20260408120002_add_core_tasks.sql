--liquibase formatted sql

--changeset auto:add-core-tasks labels:add comment:Добавление колонки type в таблицу core.tasks
--preconditions onFail:MARK_RAN
--precondition-sql-check expectedResult:0 SELECT COUNT(*) FROM information_schema.columns WHERE table_schema='core' AND table_name='tasks' AND column_name='type'

ALTER TABLE core.tasks
    ADD COLUMN type SMALLINT;
