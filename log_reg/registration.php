<?php
	if (isset($_POST['registration'])) { // Enter button 'OK'

		require_once('../connect/connect.php');

		class REGISTRATION_IN_DB {
			private $query;
			private $row;
			
			function __construct() {
				$this->query = $query;
				$this->row = $row;
			}
			
			function reg_in_database() {
				$login = $_POST['login'];
				$pass1 = $_POST['password1'];
				$pass2 = $_POST['password2'];
				$date = date('d.m.Y, H:i');
				try {
					$this->query = mysql_query("SELECT * FROM users WHERE login='$login'");
					if (!$this->query) throw new Exceptions('Server error.');
					$this->row = mysql_fetch_row($this->query);
					if (preg_match('/^(^[a-z](?=.*[A-Z])|^[A-Z](?=.*[a-z]))[0-9a-zA-Z]{6,}/', $login)) { /* LOGIN */
						if ($login != $this->row[1]) {
							if (preg_match('/(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{6,}/', $pass1)) { /* PASSWORD */
								if ($pass1 == $pass2) {
									$sql = "INSERT INTO users (login, password, status, date) VALUES ('".$login."', '".md5($pass2)."', 'user', '".$date."')";
									$query_sql = mysql_query($sql);
									if (!$query_sql) throw new Exceptions('Server error.');
									header("Location: ../form.php#popup_form_log");
								} else throw new Exceptions('Repeat password.');
							} else throw new Exceptions('Invalid password format.');
						} else throw new Exceptions('Login exists.');
					} else throw new Exceptions('Invalid login format.');
				} catch (Exceptions $ex) {
					$str = "<STYLE>.error { color: #FF0000; }</STYLE>";
					$str .= $ex->getMessage();
					$_SESSION['err_reg'] = $str;
					header("Location: ../form.php#popup_form_reg");
				}
			}
		}
		
		$regdb = new REGISTRATION_IN_DB();
		$regdb->reg_in_database();
	
	}
?>