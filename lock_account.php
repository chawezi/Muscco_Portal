<?php
	session_start();
	$url = '';

	if(!empty($_GET['url'])){
		$url = $_GET['url'];
		$_SESSION['USR_URL']	= $url;
	}

	$_SESSION['USR_SESS'] = "USER_LOCKED";

	header('Location: unlock_account.php');
