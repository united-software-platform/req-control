--liquibase formatted sql

--changeset gaybovich:insert-entity-type-nft labels:insert comment:Добавление типа сущности nft в core.entity_types
--preconditions onFail:MARK_RAN
--precondition-sql-check expectedResult:0 SELECT COUNT(*) FROM core.entity_types WHERE type = 'nft'

INSERT INTO core.entity_types (type) VALUES ('nft');
