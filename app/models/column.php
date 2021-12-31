<?php
require_once '../app/models/stikyNote.php';

class Column {

    private Database $db;

    private StikyNote $stikyNoteModel;

    public function __construct(){
        $this->db = new Database();
        $this->stikyNoteModel = new StikyNote();
    }


    public function getAll($id_workflow){
        $this->db->query('SELECT * FROM public.column WHERE id_workflow = :id_workflow order by priority ASC');
        $this->db->bind(':id_workflow', $id_workflow);

        $columns = $this->db->fetchAll();

        foreach ($columns as &$column) {
            $column->stikyNotes = $this->stikyNoteModel->getAll($column->id);
        }

        return $columns;
    }

    public function update($id,$title = null, $priority = null){
        $this->db->query('UPDATE public.column SET priority = COALESCE(:priority,priority), title = COALESCE(:title,title) WHERE id = :id');

        $this->db->bind(':priority', $priority);
        $this->db->bind(':title', $title);
        $this->db->bind(':id', $id);

        if($this->db->execute()){
            return true;
        }
        else false;
    }

    
}