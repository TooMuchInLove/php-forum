<?php
	if (isset($_POST['close'])) { // Enter button 'LOGOUT'
	
		require_once('../connect/connect.php');
		unset($_SESSION['user']);
		unset($_SESSION['status']);
		unset($_SESSION['iduser']);
		header("Location: ../form.php");
	
	}
?>