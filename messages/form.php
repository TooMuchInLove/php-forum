<?php session_start(); ?>
<!DOCTYPE html>
<HTML>
<HEAD>
	<META http-equiv="Content-Type" content="text/html; charset=utf-8">
	<META name="author" content="Fyodorov Dmitriy"/>
	<TITLE>Messages</TITLE>
	<LINK rel="stylesheet" type="text/css" href="../__style__/main.css">
</HEAD>
<BODY>
	<HEADER id="header">
		<H1>Your messages</H1>
		<!--<DIV align="right">
			<BUTTON id="btn_enter" class="button btn-group-2" title="Login" onClick="location.href='#popup_form_log'">Login</BUTTON>
			<FORM method="post" action="log_reg/logout.php">
				<BUTTON id="btn_close" class="button btn-group-2" title="Logout" name="close" type="submit">Logout</BUTTON>
			</FORM>
		</DIV>-->
	</HEADER>
	<SECTION id="main">
		<DIV align="center">
			<?php
			require_once('../connect/connect.php');

			class YOUR_MESSAGES {
				private $query;
				private $row;
				
				function __construct() {
					$this->query = $query;
					$this->row = $row;
				}
				
				function update_msg() {
					$user_n = $_SESSION['name'];	/* LOGIN  of the current USER */
					$status = $_SESSION['status'];	/* STATUS of the current USER */
					$id_user = $_SESSION['id'];		/* INDEX  of the current USER */
					try {
						$sql = "SELECT users.status, users.login, messages.date, messages.message, messages.answer
								FROM users, messages WHERE ( users.id_users='$id_user' AND users.id_users=messages.id_users )
								OR ( users.id_users=messages.id_users AND messages.answer='$user_n' ) ORDER BY id_msg DESC";
						$this->query = mysql_query($sql);
						if (!$this->query) throw new Exceptions('Server error.');
						while ($this->row = mysql_fetch_row($this->query)) {
						
							if ($this->row[0] == 'user') $cls = 'a1';
							elseif ($this->row[0] == 'moder') $cls = 'a2';
							else  $cls = 'a3';
							
							$TEG =	"<TR><TD>";
							if ($this->row[4] != 'No_answer') {
								$TEG .=	"<DIV class='left'><CODE>Message sent<A href='#'>".$this->row[4]."</A>'y</CODE></DIV>";
							} else {
								$TEG .=	"<DIV class='left'><CODE>Message sent to All</CODE></DIV>";
							}
							$TEG .=	"<DIV class='left mrn'><A class='brd-l ".$cls."' title='".$this->row[0]."' href='#'>".$this->row[1]."</A><CODE>".$this->row[2]."</CODE></DIV>";
							$TEG .=	"<DIV class='msg_style'>".$this->row[3]."</DIV>";
							$TEG .=	"</TD></TR>";
							echo $TEG;
						
						}
					} catch (Exceptions $ex) {
						echo "<STYLE>.error { color: #FF0000; }</STYLE>";
						echo "<LABEL class='error'>".$ex->getMessage()."</LABEL>";
					}
				}
			}

			$upd = new YOUR_MESSAGES();
			echo "<TABLE>";
			echo $upd->update_msg();
			echo "</TABLE>";
			?>
		</DIV>
	</SECTION>
	<STYLE>#copyright { display: block; }</STYLE>
	<FOOTER id="copyright">
		<!--<FORM method="post" action="messages/send_and_delete_message.php">
			<DIV>
				<TEXTAREA id="area" class="text-area" name="message" rows="4" placeholder="Message send..."></TEXTAREA>
			</DIV>
			<DIV align="right">
				<LABEL class='error'></LABEL>
				<BUTTON class="button btn-group-2" title="Message send" name="send" type="submit">Send</BUTTON>
				<BUTTON class="button btn-group-2" name="delete" type="submit">”далить</BUTTON>
			</DIV>
		</FORM>-->
	</FOOTER>
	<SCRIPT src="../__style__/ext-core.js"></SCRIPT>
	<SCRIPT src="../__style__/main.js"></SCRIPT>
</BODY>
</HTML>