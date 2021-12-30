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
        $this->db->query('SELECT * FROM public.column WHERE id_workflow = :id_workflow');
        $this->db->bind(':id_workflow', $id_workflow);

        $columns = $this->db->fetchAll();

        foreach ($columns as &$column) {
            $column->stikyNotes = $this->stikyNoteModel->getAll($column->id);
        }

        return $columns;
    }

    
}