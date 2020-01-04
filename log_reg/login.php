<?php
	if (isset($_POST['enter'])) { // Enter button 'LOGIN'
	
		require_once('../connect/connect.php');

		class LOG_IN_DB {
			private $query;
			private $row;
			
			function __construct() {
				$this->query = $query;
				$this->row = $row;
			}
			
			function log_in_database() {
				$login = $_POST['login'];
				$pass = md5($_POST['password']);
				$date = date('d.m.Y, H:i');
				try {
					$this->query = mysql_query("SELECT * FROM users WHERE login='$login'");
					if (!$this->query) throw new Exceptions('Server error.');
					$this->row = mysql_fetch_row($this->query);
					if ($login != '' && $pass != '') {
						if ($this->row[1] == $login && $this->row[2] == $pass) {
							$str = "<SCRIPT>var btn = document.getElementById('btn_enter'); btn.parentNode.removeChild(btn);
											document.getElementById('btn_close').style.display = 'block';</SCRIPT>";
							$str .= "<STYLE>#copyright { display: block; }</STYLE>";
							$str .= "<LABEL class='label-user' title='Your status - ".$this->row[3]."'>".$login."</LABEL><A href='messages/form.php' target='_blank' title='View the message'><IMG src='__img__/view.png' width='15' height='10'/></A><BR><CODE>".$this->row[4]."</CODE>";
							$sql = "UPDATE users SET date='".$date."' WHERE login='".$login."'";
							$query_sql = mysql_query($sql);
							if (!$query_sql) throw new Exceptions('Server error.');
							$_SESSION['name'] = $login;			/* LOGIN  of the current USER */
							$_SESSION['status'] = $this->row[3];/* STATUS of the current USER */
							$_SESSION['id'] = $this->row[0];	/* INDEX  of the current USER */
							$_SESSION['user'] = $str;
							header("Location: ../form.php");
						}
						if ($this->row[1] != $login || $this->row[2] != $pass) {
							throw new Exceptions('Error. Invalid login or password.');
						}
					} else header("Location: ../form.php#popup_form_reg");
				} catch (Exceptions $ex) {
					$str = "<STYLE>.error { color: #FF0000; }</STYLE>";
					$str .= $ex->getMessage();
					$_SESSION['err_log'] = $str;
					header("Location: ../form.php#popup_form_log");
				}
			}
		}
		
		$logdb = new LOG_IN_DB();
		$logdb->log_in_database();
	
	}
	if (isset($_POST['registration'])) { // Enter button 'REGISTRATION'
		header("Location: ../form.php#popup_form_reg");
	}
?>