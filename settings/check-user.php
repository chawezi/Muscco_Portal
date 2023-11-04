<?php
	if(!isset($_SESSION)){
		session_start();
	}
	//checks if user session is valid
	if(!isset($_SESSION['USR_ID']) && !isset($_SESSION['USR_SESS']) && $_SESSION['USR_SESS'] !='VAL' && !isset($_SESSION['USR_TYP'])){
		header('Location:../../');
	}

	

	
	