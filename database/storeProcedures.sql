-- Genera las columnas basicas de un tablero al ser creado
CREATE OR REPLACE FUNCTION public.generate_default_columns () 
RETURNS trigger AS
$$
BEGIN

    --NEW.id

    INSERT INTO public.column (id_workflow,priority,title) VALUES (NEW.id, 1,'To Do');

    INSERT INTO public.column (id_workflow,priority,title) VALUES (NEW.id, 2,'Doing');

    INSERT INTO public.column (id_workflow,priority,title) VALUES (NEW.id, 3,'Done');

    RETURN NEW;
END;
$$ LANGUAGE 'plpgsql';


DROP TRIGGER IF EXISTS  generate_default_columns on public.workflow;
-- Crea el triger a la tabla cuando se inserta
CREATE TRIGGER generate_default_columns
AFTER INSERT ON public.workflow
FOR EACH ROW EXECUTE
PROCEDURE public.generate_default_columns();

