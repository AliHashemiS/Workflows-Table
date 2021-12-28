<?php
	/**
	 * Class Database
	 * mange sql queries
	 */
	class Database {
		private $dbHost = DB_HOST;
		private $dbUser = DB_USER;
		private $dbPass = DB_PASS;
		private $dbName = DB_NAME;
		private $dbPort = DB_PORT;
		
		private $statement;
		private $dbHandler;
		private $error;
		
		/**
		 * Database constructor.
		 * Enable database conection
		 */
		public function __construct() {
			$conn = 'pgsql:host=' . $this->dbHost .';port='.$this->dbPort.';dbname=' . $this->dbName;

			$options = array(
				PDO::ATTR_PERSISTENT => true,
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
			);
			try {
				$this->dbHandler = new PDO($conn, $this->dbUser, $this->dbPass, $options);
			} catch (PDOException $e) {
				$this->error = $e->getMessage();
				echo $this->error;
			}
		}
		
		// write sql queries
		public function query($sql) {
			$this->statement = $this->dbHandler->prepare($sql);
		}
		
		// bind values
		public function bind($parameter, $value, $type = null) {
			switch (is_null($type)) {
				case is_int($value):
					$type = PDO::PARAM_INT;
					break;
				case is_bool($value):
					$type = PDO::PARAM_BOOL;
					break;
				case is_null($value):
					$type = PDO::PARAM_NULL;
					break;
				default:
					$type = PDO::PARAM_STR;
			}
			$this->statement->bindValue($parameter, $value, $type);
		}
		
		// Execute statment created
		public function execute() {
			return $this->statement->execute();
		}
		
		// return array
		public function fetchAll() {
			$this->execute();
			return $this->statement->fetchAll(PDO::FETCH_OBJ);
		}
		
		// return rown like object
		public function fetch() {
			$this->execute();
			return $this->statement->fetch(PDO::FETCH_OBJ);
		}
		
		// get total rows
		public function rowCount() {
			return $this->statement->rowCount();
		}
	}
