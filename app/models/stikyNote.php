<?php

class StikyNote {

    private Database $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getAll($id_column){
        $this->db->query('SELECT * FROM public.stiky_note WHERE id_column = :id_column order by priority ASC');
        $this->db->bind(':id_column', $id_column);
        return $this->db->fetchAll();
    }

    public function update($id, $content = null, $color = null, $priority = null, $id_column = null){
        $this->db->query('UPDATE public.stiky_note SET id_column = COALESCE(:id_column,id_column), priority = COALESCE(:priority,priority), color = COALESCE(:color,color), content = COALESCE(:content,content) WHERE id = :id');

        $this->db->bind(':color', $color);
        $this->db->bind(':content', $content);
        $this->db->bind(':priority', $priority);
        $this->db->bind(':id_column', $id_column);
        $this->db->bind(':id', $id);

        if($this->db->execute()){
            return true;
        }
        else false;
    }

    
    public function delete($id){
        $this->db->query('DELETE FROM public.stiky_note WHERE id = :id');
        $this->db->bind(':id', $id);
        if($this->db->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    public function create($data){
        $this->db->query('INSERT INTO public.stiky_note (id_column,content,priority) values(:id_column,:content, :priority) returning stiky_note.id;');
        $this->db->bind(':id_column', $data['id_column']);
        $this->db->bind(':content', $data['content']);
        $this->db->bind(':priority', $data['priority']);
        return $this->db->fetch();
    }


}