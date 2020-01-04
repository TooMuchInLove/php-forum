<?php
	require_once('../connect/connect.php');
	$user_name = $_SESSION['name']; /* LOGIN  of the current USER */
	$id_user = $_SESSION['id'];		/* INDEX  of the current USER */
	
	class SEND_THE_MESSAGE {
		private $query_1;
		private $query_2;
		private $row_1;
		private $row_2;
		private $FLAG_USER;
		
		function __construct($user_name) {
			$this->un = $user_name;
			$this->q1 = $query_1;
			$this->q2 = $query_2;
			$this->r1 = $row_1;
			$this->r2 = $row_2;
			$this->FU = $FLAG_USER;
		}
		
		function send_msg() {
			$msg = $_POST['message'];
			$date = date('d.m.Y, H:i');
			try {
				if ($msg == '') throw new Exceptions('Enter message.');
				$sql = "SELECT id_users FROM users WHERE login='".$this->un."'";
				$this->q1 = mysql_query($sql);
				if (!$this->q1) throw new Exceptions('Server error.');
				$this->r1 = mysql_fetch_row($this->q1);
				
				if (preg_match_all('/^@([a-zA-Z0-9]+), /', $msg, $result)) { /* If the answer is typed */
					$answer_name = preg_replace('/(@|,|[ ]+)/', '', $result[0][0], 3);	/* Delete '@', ',' и ' ' */
					if ($answer_name == $this->un) throw new Exceptions('You can\'t send a message to yourself.');
					$message = preg_replace('/^@([a-zA-Z0-9]+), /', '', $msg, 1);	/* Delete from the message, for example, '@AdMiN123, ' */
					if ($message == '') throw new Exceptions('Enter message.');
					$sql = "SELECT login FROM users";
					$this->q2 = mysql_query($sql);
					if (!$this->q2) throw new Exceptions('Server error.');
					while ($this->r2 = mysql_fetch_row($this->q2)) { /* Check login */
						$this->FU = false; /* Flag (user - true) */
						if ($answer_name == $this->r2[0]) { /*  */
							$sql = "INSERT INTO messages (message, answer, date, id_users)
									VALUES ('".$message."', '".$answer_name."', '".$date."', '".$this->r1[0]."')";
							$this->query = mysql_query($sql);
							if (!$this->query) throw new Exceptions('Server error.');
							$this->FU = true;
							break;
						}
					}
					if (!$this->FU) throw new Exceptions('The user you want to send the message to does not exist.');
				} else { /* Plain text */
					$sql = "INSERT INTO messages (message, answer, date, id_users)
							VALUES ('".$msg."', 'No_answer', '".$date."', '".$this->r1[0]."')";
					$this->query = mysql_query($sql);
					if (!$this->query) throw new Exceptions('Server error.');
				}
				header("Location: ../form.php");
			} catch (Exceptions $ex) {
				$str = "<STYLE>.error { color: #FF0000; }</STYLE>";
				$str .= $ex->getMessage();
				$_SESSION['err_msg'] = $str;
				header("Location: ../form.php");
			}
		}
	}
		
	class DELETE_THE_MESSAGE {
		private $query;
		private $row;
		
		function __construct($user_name) {
			$this->un = $user_name;
			$this->id = $id_user;
			$this->query = $query;
			$this->row = $row;
		}
		
		function delete_msg() {
			try {
				$id_msg = $_SESSION['id_msg'];
				if ($id_msg != null) throw new Exceptions($id_msg);
				/*$sql = "SELECT id_users, login FROM users WHERE login='".$this->un."'";
				$this->query = mysql_query($sql);
				if (!$this->query) throw new Exceptions('Server error.');
				$this->row = mysql_fetch_row($this->query);
				$sql = "DELETE messages FROM messages LEFT JOIN users ON users.id_users=messages.id_users
						WHERE messages.id_users='".$this->row[0]."'";*/
				/*$sql = "DELETE messages FROM messages LEFT JOIN users ON users.id_users=messages.id_users
						WHERE messages.id_users='".$this->id."'";*/
				$sql = "DELETE messages FROM messages
						WHERE messages.id_msg='".$id_msg."'";
				//$sql = "DELETE FROM messages WHERE id_msg = (SELECT id_msg FROM messages ORDER BY id DESC LIMIT 1)";
				$this->query = mysql_query($sql);
				if (!$this->query) throw new Exceptions('Server error.');
				header("Location: ../form.php");
			} catch (Exceptions $ex) {
				$str = "<STYLE>.error { color: #FF0000; }</STYLE>";
				$str .= $ex->getMessage();
				$_SESSION['err_msg'] = $str;
				header("Location: ../form.php");
			}
		}
	}
	
	if(isset($_POST['send'])) { // Enter button 'SEND'
		
		$msg = new SEND_THE_MESSAGE($user_name);
		$msg->send_msg();
	
	}
	
	//if(isset($_POST['delete'])) { // Enter button 'DELETE'
	if(isset($_POST['delete_msg'])) { // Enter button 'x'
		
		$msg = new DELETE_THE_MESSAGE($user_name, $id_user);
		$msg->delete_msg();
	
	}
?>