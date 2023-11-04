<?php
	session_start();
	unset($_SESSION["USR_ID"]);
	unset($_SESSION["USR_NME"]);
	unset($_SESSION["USR_OF"]);
	header("Location: ./");
	session_destroy();
?>