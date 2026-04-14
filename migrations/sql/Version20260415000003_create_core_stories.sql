--liquibase formatted sql

--changeset gaybovich:Version20260415000003_create_core_stories
CREATE TABLE core.stories (
    id          BIGSERIAL       PRIMARY KEY,
    epic_id     BIGINT          NOT NULL,
    title       VARCHAR(200)    NOT NULL,
    description TEXT,
    created_at  TIMESTAMPTZ     NOT NULL DEFAULT NOW(),
    updated_at  TIMESTAMPTZ     NOT NULL DEFAULT NOW(),

    CONSTRAINT fk_stories_epic_id
        FOREIGN KEY (epic_id)
            REFERENCES core.epics(id)
            ON DELETE RESTRICT
            ON UPDATE CASCADE
);

CREATE INDEX idx_core_stories_epic_id ON core.stories (epic_id);
--rollback DROP TABLE core.stories;
