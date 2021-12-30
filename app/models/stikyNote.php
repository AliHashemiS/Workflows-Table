<?php

class StikyNote {

    private Database $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getAll($id_column){
        $this->db->query('SELECT * FROM public.stiky_note WHERE id_column = :id_column');
        $this->db->bind(':id_column', $id_column);
        return $this->db->fetchAll();
    }

}