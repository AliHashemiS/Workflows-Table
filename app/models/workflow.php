<?php

class Workflow {

    private Database $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function create($data){
        $this->db->query('INSERT INTO public.workflow (id_user,name,description) values(:id_user,:name, :description)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':id_user', $data['id_user']);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }


    public function getAll($data){
        $this->db->query('SELECT * FROM public.workflow WHERE id_user = :id_user');
        $this->db->bind(':id_user', $data['id_user']);
        return $this->db->fetchAll();
    }

}