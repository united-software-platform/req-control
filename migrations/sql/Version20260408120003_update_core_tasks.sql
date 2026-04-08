--liquibase formatted sql

--changeset auto:update-core-tasks labels:update comment:Установка NOT NULL для колонки type в таблице core.tasks

ALTER TABLE core.tasks
    ALTER COLUMN type SET NOT NULL;
