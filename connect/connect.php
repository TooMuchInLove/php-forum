<?php
	session_start();
	
	class Exceptions extends Exception {
		public function __construct($exception) {
			parent::__construct($exception);
		}
	}
	
	class DB {
		private $connect;
		private $select;
		
		function __construct() {
			$this->con = $connect;
			$this->sel = $select;
		}
		
		function connection_database() {
			define('DB_HOST', 'localhost');
			define('DB_USER', 'root');	// 'root', 'pr20'
			define('DB_PASS', '');		// '', 	   'pr20'
			define('DB_NAME', 'pr20');	// 'pr20', 'db_users'
			
			try {
				$this->con = mysql_connect(DB_HOST, DB_USER, DB_PASS);
				if (!$this->con) throw new Exceptions('Server error.');
				$this->sel = mysql_select_db(DB_NAME);
				mysql_query("SET NAMES `CP1251`");
				if (!$this->sel) throw new Exceptions('Server error.');
			} catch (Exceptions $ex) {
				$str = "<STYLE>.error { color: #FF0000; }</STYLE>";
				$str .= $ex->getMessage();
				$_SESSION['conn'] = $str;
				header("Location: ../form.php");
			}
		}
	}
	
	$db = new DB();
	$db->connection_database();
?>