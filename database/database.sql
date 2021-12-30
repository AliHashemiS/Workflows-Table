DROP table IF EXISTS public.user CASCADE;
CREATE TABLE public.user(
    id          serial primary key,
    email       VARCHAR(100) not null,
    password    varchar(1024) not null,
    created_at  timestamp  DEFAULT CURRENT_TIMESTAMP,
    updated_at  timestamp  DEFAULT CURRENT_TIMESTAMP
);

DROP table IF EXISTS public.workflow CASCADE;
CREATE TABLE public.workflow(
    id          serial primary key,
    id_user     int NOT NULL,
    name        VARCHAR(250) NOT NULL,
    description VARCHAR(500) NOT NULL,
    created_at  timestamp  DEFAULT CURRENT_TIMESTAMP,
    updated_at  timestamp  DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT user_id FOREIGN KEY (id_user) REFERENCES public.user (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE CASCADE
        NOT VALID
);


DROP table IF EXISTS public.column CASCADE;
CREATE TABLE public.column(
    id          serial primary key,
    id_workflow int NOT NULL,
    priority    real NOT NULL,
    title       VARCHAR(50) NOT NULL,
    created_at  timestamp  DEFAULT CURRENT_TIMESTAMP,
    updated_at  timestamp  DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT workflow_id FOREIGN KEY (id_workflow) REFERENCES public.workflow (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE CASCADE
        NOT VALID
);


DROP table IF EXISTS public.stiky_note CASCADE;
CREATE TABLE public.stiky_note(
    id          serial primary key,
    id_column   int NOT NULL,
    content     VARCHAR(1024),
    priority    real NOT NULL,
    color       CHAR(7) DEFAULT '#FFFFFF',
    created_at  timestamp  DEFAULT CURRENT_TIMESTAMP,
    updated_at  timestamp  DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT column_id FOREIGN KEY (id_column) REFERENCES public.column (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE CASCADE
        NOT VALID
);