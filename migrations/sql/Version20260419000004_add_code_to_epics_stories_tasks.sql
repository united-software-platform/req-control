--liquibase formatted sql

--changeset gaybovich:add-code-to-epics-stories-tasks labels:alter comment:Добавление поля code в таблицы epics, stories, tasks

ALTER TABLE core.epics  ADD COLUMN IF NOT EXISTS code VARCHAR(100) NOT NULL DEFAULT '';
ALTER TABLE core.stories ADD COLUMN IF NOT EXISTS code VARCHAR(100) NOT NULL DEFAULT '';
ALTER TABLE core.tasks   ADD COLUMN IF NOT EXISTS code VARCHAR(100) NOT NULL DEFAULT '';