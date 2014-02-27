<?php
	session_start();
	// unset($_SESSION['username']);
	// unset($_SESSION['password']);
	// unset($_SESSION['id']);
	// unset($_SESSION['PHPSESSID']);
	// $_SESSION['idy'] = false;
	// session_unset();
	session_destroy();
	header('Location: index.php?code=2');
?>