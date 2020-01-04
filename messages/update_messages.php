<?php
	require_once('connect/connect.php');
	
	class UPDATE_MESSAGES {
		private $query;
		private $row;
		
		function __construct() {
			$this->query = $query;
			$this->row = $row;
		}
		
		private function their_output_msg($cls, $status, $log, $date, $msg, $answer, $btn_id=null) {
			$TEG =	"<TR><TD>";
			/*$TEG .= "<FORM method='post' action='messages/send_and_delete_message.php'>";
			$TEG .= "<BUTTON class='del-msg align-r' name='delete_msg'>".$btn_id."</BUTTON>";
			$TEG .= "</FORM>";*/
			if ($answer != 'No_answer') {
				$TEG .=	"<DIV class='left'><CODE>Message sent<A href='#' onClick=\"ta('@".$answer.", ')\">".$answer."</A>'y</CODE></DIV>";
			} else {
				$TEG .=	"<DIV class='left'><CODE>Message sent to All</CODE></DIV>";
			}
			$TEG .=	"<DIV class='left mrn'><A class='brd-l ".$cls."' title='".$status."' href='#' onClick=\"ta('@".$log.", ')\">".$log."</A><CODE>".$date."</CODE></DIV>";
			$TEG .=	"<DIV class='msg_style'>".$msg."</DIV>";
			$TEG .=	"</TD></TR>";
			echo $TEG;
		}
		
		private function my____output_msg($cls, $status, $log, $date, $msg, $answer, $btn_id=null) {
			$TEG =	"<TR><TD>";
			/*if ($btn_id != null) {  BUTTON DELETE 
				$TEG .= "<FORM method='post' action='messages/send_and_delete_message.php'>";
				$_SESSION['id_msg'] = $btn_id;
				$TEG .= "<BUTTON class='del-msg align-l' name='delete_msg'>x</BUTTON>";
				$TEG .= "</FORM>";
			}*/
			if ($answer != 'No_answer') {
				$TEG .=	"<DIV class='right'><CODE>Message sent<A href='#' onClick=\"ta('@".$answer.", ')\">".$answer."</A>'y</CODE></DIV>";
			} else {
				$TEG .=	"<DIV class='right'><CODE>Message sent to All</CODE></DIV>";
			}
			$TEG .=	"<DIV class='right mrn'><CODE>".$date."</CODE><A class='brd-r ".$cls."' title='".$status."' href='#' onClick=\"ta('@".$log.", ')\">".$log."</A></DIV>";
			$TEG .=	"<DIV class='msg_style'>".$msg."</DIV>";
			$TEG .=	"</TD></TR>";
			echo $TEG;
		}
		
		function update_msg() {
			$user_n = $_SESSION['name'];	/* LOGIN  of the current USER */
			$status = $_SESSION['status'];	/* STATUS of the current USER */
			$id_user = $_SESSION['id'];		/* INDEX  of the current USER */
			echo "<SCRIPT>function ta(value) { var area = document.getElementById('area'); area.value = value; }</SCRIPT>";
			try {
				$sql = "SELECT users.status, users.login, messages.date, messages.message, messages.answer, messages.id_msg
						FROM messages, users WHERE messages.id_users=users.id_users ORDER BY id_msg DESC";
				$this->query = mysql_query($sql);
				if (!$this->query) throw new Exceptions('Server error.');
				while ($this->row = mysql_fetch_row($this->query)) {
				
					if ($this->row[0] == 'user') $cls = 'a1';
					elseif ($this->row[0] == 'moder') $cls = 'a2';
					else $cls = 'a3';
					
					switch ($status) { /* STATUS - USER */
						case 'user':
						case 'moder':
						case 'admin':
							if ($this->row[1] == $user_n) {
								$this->my____output_msg($cls, $this->row[0], $this->row[1], $this->row[2], $this->row[3], $this->row[4], $this->row[5]);
							} else {
								$this->their_output_msg($cls, $this->row[0], $this->row[1], $this->row[2], $this->row[3], $this->row[4], $this->row[5]);
							}
					}
				}
			} catch (Exceptions $ex) {
				echo "<STYLE>.error { color: #FF0000; }</STYLE>";
				echo "<LABEL class='error'>".$ex->getMessage()."</LABEL>";
			}
		}
	}
	
	$upd = new UPDATE_MESSAGES();
	echo "<TABLE>";
	echo $upd->update_msg();
	echo "</TABLE>";
?>