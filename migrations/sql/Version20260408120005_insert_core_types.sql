--liquibase formatted sql

--changeset auto:insert-core-types labels:insert comment:Начальное заполнение таблицы core.types

INSERT INTO core.types (name) VALUES
    ('Задача'),
    ('Стори'),
    ('Эпик');