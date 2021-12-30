<?php
require_once '../app/models/column.php';

class Workflow {

    private Database $db;

    private Column $columnModel;

    public function __construct(){
        $this->db = new Database();
        $this->columnModel = new Column();
    }

    public function update($id, $name = null, $description = null){
        $this->db->query('UPDATE public.workflow SET name = COALESCE(:name,name), description = COALESCE(:description,description),updated_at = CURRENT_TIMESTAMP where id = :id');

        $this->db->bind(':name', $name);
        $this->db->bind(':description', $description);
        $this->db->bind(':id', $id);
        if($this->db->execute()){
            return true;
        }
        else false;
    }


    public function create($data){
        $this->db->query('INSERT INTO public.workflow (id_user,name,description) values(:id_user,:name, :description) returning workflow.id;');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':id_user', $data['id_user']);
        return $this->db->fetch();
    }

    public function delete($id){
        $this->db->query('DELETE FROM public.workflow WHERE id = :id');
        $this->db->bind(':id', $id);
        if($this->db->execute()){
            return true;
        }
        else{
            return false;
        }
    }


    public function getAll($data){
        $this->db->query('SELECT * FROM public.workflow WHERE id_user = :id_user');
        $this->db->bind(':id_user', $data['id_user']);
        return $this->db->fetchAll();
    }

    public function find($id){
        $this->db->query('SELECT * FROM public.workflow WHERE id = :id');
        $this->db->bind(':id', $id);

        $workflow = $this->db->fetch();

        $workflow->columns = $this->columnModel->getAll($id);
        return $workflow;
    }

}