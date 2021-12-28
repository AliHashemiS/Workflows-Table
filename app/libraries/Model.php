<?php

    /**
	 * Class Model
	 * Main class used for all models in the project
	 */
    class Model{

        protected Database $db;

        public function __construct()
        {
            $this->db = new Database();
        }


    }

?>