<?php
	unset($_SESSION['username']);
	unset($_SESSION['password']);
	unset($_SESSION['id']);
	unset($_SESSION['PHPSESSID']);
	session_unset();
	session_destroy();
	header('Location: index.php?code=2');
?>