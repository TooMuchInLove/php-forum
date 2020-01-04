<?php session_start(); ?>
<!DOCTYPE html>
<HTML>
<HEAD>
	<META http-equiv="Content-Type" content="text/html; charset=utf-8">
	<META name="author" content="Fyodorov Dmitriy"/>
	<TITLE>Forum</TITLE>
	<LINK rel="stylesheet" type="text/css" href="__style__/main.css">
</HEAD>
<BODY>
	<DIV id="popup_form_log">
		<DIV id="dark_bg"></DIV>
		<DIV id="window" align="center">
			<BUTTON class="button btn-close" onClick="location.href='#'">x</BUTTON>
			<H2>Login</H2>
			<FORM method="post" action="log_reg/login.php">
				<DIV><INPUT class="field" type="text" name="login" placeholder="Login"></DIV>
				<DIV><INPUT class="field" type="password" name="password" placeholder="Password"></DIV>
				<DIV>
					<BUTTON class="button btn-group-1" type="reset">Cancel</BUTTON>
					<BUTTON class="button btn-group-1" name="enter" type="submit">Login</BUTTON>
					<BUTTON class="button btn-group-1" name="registration" type="submit">Registration</BUTTON>
				</DIV>
			</FORM>
			<LABEL class='error'><?php echo $_SESSION['err_log']; unset($_SESSION['err_log']); ?></LABEL>
		</DIV>
	</DIV>
	<DIV id="popup_form_reg">
		<DIV id="dark_bg"></DIV>
		<DIV id="window" align="center">
			<BUTTON class="button btn-close" onClick="location.href='#'">x</BUTTON>
			<H2>Registration</H2>
			<FORM method="post" action="log_reg/registration.php">
				<DIV><INPUT class="field" type="text" name="login" placeholder="Login"></DIV>
				<DIV><INPUT class="field" type="password" name="password1" placeholder="Password"></DIV>
				<DIV><INPUT class="field" type="password" name="password2" placeholder="Repeat password"></DIV>
				<DIV>
					<BUTTON class="button btn-group-1" type="reset">Cancel</BUTTON>
					<BUTTON class="button btn-group-1" name="registration" type="submit">Ok</BUTTON>
				</DIV>
			</FORM>
			<LABEL class='error'><?php echo $_SESSION['err_reg']; unset($_SESSION['err_reg']); ?></LABEL>
		</DIV>
	</DIV>
	<HEADER id="header">
		<H1>Forum</H1>
		<DIV align="right">
			<BUTTON id="btn_enter" class="button btn-group-2" title="Login" onClick="location.href='#popup_form_log'">Login</BUTTON>
			<FORM method="post" action="log_reg/logout.php">
				<BUTTON id="btn_close" class="button btn-group-2" title="Logout" name="close" type="submit">Logout</BUTTON>
			</FORM>
			<?php echo $_SESSION['user']; ?>
		</DIV>
	</HEADER>
	<SECTION id="main">
		<DIV align="center">
			<?php require_once('messages/update_messages.php'); // Oбновление чата; ?>
		</DIV>
	</SECTION>
	<FOOTER id="copyright">
		<FORM method="post" action="messages/send_and_delete_message.php">
			<DIV>
				<TEXTAREA id="area" class="text-area" name="message" rows="4" placeholder="Message send..."></TEXTAREA>
			</DIV>
			<DIV align="right">
				<LABEL class='error'><?php echo $_SESSION['err_msg']; unset($_SESSION['err_msg']); ?></LABEL>
				<BUTTON class="button btn-group-2" title="Message send" name="send" type="submit">Send</BUTTON>
				<BUTTON class="button btn-group-2" title="Delete last message" name="delete" type="submit">Delete</BUTTON>
			</DIV>
		</FORM>
	</FOOTER>
	<SCRIPT src="__style__/ext-core.js"></SCRIPT>
	<SCRIPT src="__style__/main.js"></SCRIPT>
</BODY>
</HTML>