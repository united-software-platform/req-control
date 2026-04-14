--liquibase formatted sql

--changeset gaybovich:Version20260415000006_insert_core_statuses
INSERT INTO core.statuses (id, name) VALUES
    (1, 'Новая'),
    (2, 'В работе'),
    (3, 'Тестирование'),
    (4, 'На уточнении'),
    (5, 'Готово');
--rollback DELETE FROM core.statuses WHERE id IN (1, 2, 3, 4, 5);
