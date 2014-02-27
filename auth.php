<?php
	session_start();

	if ($_SESSION['idy'] != true || $_SESSION['username'] == null) {
		header("Location:./index.php?code=3");
	}
?>